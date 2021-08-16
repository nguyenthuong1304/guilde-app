<?php

namespace App\Http\Livewire\Admin\Post;

use App\Http\Livewire\Admin\BaseComponent;
use App\Models\Tag;
use App\Traits\MixedComponent;
use App\Models\Category;
use App\Models\Post;
use App\Services\FileService;
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

    public array $form = [
        'id' => null,
        'category_id' => null,
        'slug' => null,
        'name' => null,
        'description' => null,
        'content' => null,
        'image' => null,
        'published' => true,
        'tag_ids' => [],
    ];

    public $ids = [];

    public array $rules = [
        'form.name' => 'required|string|min:5|max:100',
        'form.slug' => 'required|string|unique:posts,slug',
        'form.description' => 'nullable|string|max:1000',
        'form.content' => 'required|string',
        'form.image' => 'nullable|file|mimes:jpeg,jpg,png|max:4000',
        'form.category_id' => 'required|exists:categories,id',
        'form.published' => 'nullable|boolean',
        'form.tags' => 'nullable|array',
        'form.tags.*' => 'integer|exists:tags,id',
    ];

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
        if ($id) {
            $post = Post::with('tags')->findOrFail($id);
            $this->post = $post;
            $this->form = $post->toArray();
            $this->ids = array_column($this->form['tags'], 'id');
        }
    }

    public function render()
    {
        return view('livewire.admin.post.post', [
            'categories' => Category::all(),
            'tags' => Tag::all(),
            'action' => !empty($this->form['id']) ? 'update' : 'store',
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
        $this->validate();
        if ($this->form['image'] instanceof UploadedFile) {
            $this->form['image'] = $fileService->save($this->form['image'], self::PATH);
        }
        if ($this->form['published']) {
            $this->form['published_at'] = now();
        }
        Post::create($this->form);

        session()->flash('message', ['type' => 'success', 'message' => 'Create post successfully']);
        $this->resetForm();
        $this->redirectRoute('post_index');
    }

    public function update(FileService $fileService)
    {
        if (is_string($this->form['image'])) {
            $this->rules['form.image'] = [
                'nullable',
                'string',
                function ($attr, $val, $fail) {
                    if (!str_contains($val, $this->post->image)) {
                        $fail('validation.exists');
                    }
                },
            ];
        } else {
            $this->rules['form.image'] = 'required|file|mimes:jpeg,jpg,png|max:4000';
        }
        $this->rules['form.slug'] = 'unique:posts,slug,'.$this->form['id'].',id';
        $this->validate();
        if ($this->form['image'] instanceof UploadedFile) {
            $fileService->delete($this->post->image);
            $this->form['image'] = $fileService->save($this->form['image'], self::PATH);
        } else {
            $this->form['image'] = $this->post->image == '/images/no-image.png'
                ? null
                : replaceImage($this->post->image);
        }
        if ($this->form['published'] && !$this->form['published_at']) {
            $this->form['published_at'] = now();
        }

        $this->post->tags()->sync($this->form['tags']);
        $this->post->update($this->form);

        session()->flash('message', ['type' => 'success', 'message' => 'Update post successfully']);
        $this->redirectRoute('post_index');
    }

    public function resetForm(): void
    {
        foreach ($this->form as $key => $item)
            if (isset($this->form[$key]))
                $this->form[$key] = is_array($this->form[$key]) ? [] : null;
    }

    public function updateSlug($name): void
    {
        $this->form['slug'] = Str::slug($name);
    }

    public function setContent($val): void
    {
        $this->form['content'] = $val;
    }

    public function setSelected($val)
    {
        $this->form['tag_ids'] = $val;
    }
}
