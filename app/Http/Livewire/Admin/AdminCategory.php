<?php

namespace App\Http\Livewire\Admin;

use App\Services\FileService;
use App\Traits\MixedComponent;
use App\Models\Category;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class AdminCategory extends BaseComponent
{
    use WithPagination, WithFileUploads, MixedComponent;

    protected string $view = 'livewire.admin.category.index';

    protected $listeners = [
        'resetInput' => 'resetInput',
    ];

    public Category $category;
    public $image;

    public $deleteId = null;
    public $search = '';
    public $isEdit = false;

    protected $rules = [];

    public function mount()
    {
        $this->category = Category::firstOrNew(['id' => $this->category->id ?? null]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updated($field)
    {
        $this->validateOnly($field, $this->rules());
    }

    public function render()
    {
        return view('livewire.admin.category.index', [
            'categories' => Category::where('name', 'like', '%'.$this->search.'%')
                ->orderBy('created_at')
                ->paginate($this->perPage),
            'parents' => Category::select('id', 'name')->whereNull('parent_id')->get(),
        ])
            ->extends($this->extends)
            ->section($this->section);
    }

    public function save(FileService $fileService)
    {
        $this->validate();
        try {
            if ($this->image instanceof UploadedFile) {
                $this->category->image = $fileService->save($this->image, 'category');
            } else {
                if (str_contains($this->category->image, 'no-image')) {
                    $this->category->image = null;
                }
            }
            unset($this->category->id);
            $this->category->save();
            $this->emit('alert', [
                'success',
                'Create category success'
            ]);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function edit($id)
    {
        $this->isEdit = true;
        $this->category = Category::findOrFail($id);
    }

    public function resetInput()
    {
        $this->category = new Category();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function delete()
    {
        Category::destroy($this->deleteId);

        $this->emit('alert', [
            'success',
            'Delete category success'
        ]);
    }

    public function updateStatus($id)
    {
        $cate = Category::find($id);
        $cate->update(['show_index_page' => !$cate->show_index_page]);
    }

    public function rules()
    {
        $id = $this->category->id ?? 0;

        return [
            'category.id' => 'nullable|integer',
            'category.name' => 'required|string|max:100|unique:categories,name,'.$id,
            'category.description' => 'nullable|string|max:1000',
            'image' => 'nullable|file|mimes:jpeg,jpg,png|max:4000',
            'category.parent_id' => [
                'nullable',
                Rule::exists('categories', 'id')->where('deleted_at')->where('parent_id')
            ],
        ];
    }
}
