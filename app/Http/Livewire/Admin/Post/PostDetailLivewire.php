<?php

namespace App\Http\Livewire\Admin\Post;

use App\Http\Livewire\Admin\BaseComponent;
use App\Models\Tag;
use App\Traits\MixedComponent;
use App\Models\Category;
use App\Models\Post;
use App\Services\FileService;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;

class PostDetailLivewire extends BaseComponent
{
    use WithFileUploads, MixedComponent;

    const PATH = 'post';

    protected $listeners = [
        'contentUpdated' => 'setContent',
        'selected' => 'setSelected',
    ];

    public Post $post;
    public $image;
    public $ids = [];
    public array $rules = [];
    public array $validationAttributes = [
        'form.name' => 'Name',
        'form.slug' => 'Slug',
        'form.description' => 'Description',
        'form.content' => 'Content',
        'form.image' => 'Image',
        'form.category_id' => 'Category Id',
        'form.published' => 'Published',
    ];

    public function mount(int|null $id = null)
    {
        $this->post = Post::with('tags')->firstOrNew(['id' => $id]);
        if ($cloneId = request()->get('clone_id')) {
            if ($postClone = Post::with('tags:id')->find($cloneId)) {
                $this->post->name = $postClone->name . ' (copy)';
                $this->post->slug = $postClone->slug . '-copy';
                $this->post->category_id = $postClone->category_id;
                $this->post->published = $postClone->published;
                $this->ids = $postClone->tags->pluck('id')->toArray();
            }
        }

        if ($id) {
            $this->ids = $this->post->tags->pluck('id')->toArray();
        }
    }

    public function render()
    {
        return view('livewire.admin.post.post', [
            'categories' => Category::all(),
            'tags' => Tag::all(),
            'action' => !empty($this->post->id) ? 'update' : 'store',
        ])
            ->extends($this->extends)
            ->section($this->section);
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function store(FileService $fileService): void
    {
        try {
            $this->validate();
            if ($this->image instanceof UploadedFile) {
                $this->post->image = $fileService->save($this->image, self::PATH);
            }
            if ($this->post->published) {
                $this->post->published_at = now();
            }
            $this->savePost();
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function update(FileService $fileService)
    {
        if (is_string($this->image)) {
            $this->rules['image'] = [
                'nullable',
                'string',
                function ($attr, $val, $fail) {
                    if (!str_contains($val, $this->post->image)) {
                        $fail('validation.exists');
                    }
                },
            ];
        } else {
            $this->rules['image'] = 'required|file|mimes:jpeg,jpg,png|max:4000';
        }
        $this->validate();
        if ($this->image instanceof UploadedFile) {
            $fileService->delete($this->post->image);
            $this->post->image = $fileService->save($this->image, self::PATH);
        } else {
            if (str_contains($this->post->image, 'no-image')) {
                $this->post->image = null;
            }
        }
        if ($this->post->published && !$this->post->published_at) {
            $this->post->published_at = now();
        }
        $this->savePost();
    }

    public function resetForm(): void
    {
        $this->post = new Post();
    }

    public function updateSlug($name): void
    {
        $this->post->slug = Str::slug($name);
    }

    public function setContent($val): void
    {
        $this->post->content = $val;
    }

    public function setSelected($val)
    {
        $this->ids = $val;
    }

    public function rules()
    {
        $id = $this->post->id ?? 0;

        return [
            'post.name' => 'required|string|min:5|max:100|unique:posts,name,'.$id,
            'post.slug' => 'required|string|unique:posts,slug,'.$id,
            'post.description' => 'nullable|string|max:1000',
            'post.content' => 'required|string',
            'post.image' => 'nullable|file|mimes:jpeg,jpg,png|max:4000',
            'post.category_id' => 'required|exists:categories,id',
            'post.published' => 'nullable|boolean',
            'post.tags' => 'nullable|array',
            'post.tags.*' => [
                function ($attr, $val, $fail) {
                    if (is_numeric($val)) {
                        if (Tag::where('id', $val)->exists()) {
                            $fail(__('validation.exists'));
                        }
                    }
                },
            ],
        ];
    }

    private function savePost()
    {
        unset($this->post->tags);
        $this->handleTag();
        $this->post->tags()->sync($this->ids);
        $this->post->save();
        session()->flash('message', ['type' => 'success', 'message' => 'Create post successfully']);
        $this->redirectRoute('post_index');
    }

    private function handleTag()
    {
        $this->ids = array_map(function ($tag) {
            if (!is_numeric($tag)) {
                return Tag::firstOrCreate(['name' => $tag, 'count_click' => 0])->id;
            }

            return $tag;
        }, $this->ids);
    }
}
