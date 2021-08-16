<?php

namespace App\Http\Livewire\Admin;

use App\Services\FileService;
use App\Traits\MixedComponent;
use App\Models\Category;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class CategoryLivewire extends BaseComponent
{
    use WithPagination, WithFileUploads, MixedComponent;

    protected string $view = 'livewire.admin.category.index';

    protected $listeners = [
        'resetInput' => 'resetInput',
    ];

    public $deleteId = null;
    public $idCate, $name, $description, $image, $parent_id = null;
    public $search = '';
    public $isEdit = false;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updated($field)
    {
        $id = $this->idCate ?? 0;
        $this->validateOnly($field, [
            'name' => 'required|string|max:100|unique:categories,name,'.$id,
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|file|mimes:jpeg,jpg,png|max:4000',
            'parent_id' => [
                'nullable',
                Rule::exists('categories', 'id')->where('deleted_at')->where('parent_id')
            ],
        ]);
    }

    public function render()
    {
        return view('livewire.admin.category.index', [
            'objects' => Category::where('name', 'like', '%'.$this->search.'%')->orderBy('created_at')->paginate($this->perPage),
            'parents' => Category::select('id', 'name')->whereNull('parent_id')->get(),
            'fields' => [
                'image',
                'id',
                'name',
                'parent_id',
                'created_at',
                'updated_at',
            ],
        ])
            ->extends($this->extends)
            ->section($this->section);
    }

    public function save(FileService $fileService)
    {
        try {
            if ($this->image instanceof UploadedFile) {
                $this->image = $fileService->save($this->image, 'category');
            }
            Category::updateOrCreate(['id' => $this->idCate],[
                'name' => $this->name,
                'description' => $this->description,
                'parent_id' => $this->parent_id,
                'image' => $this->image,
            ]);
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
        $Category = Category::findOrFail($id);
        $this->name = $Category->name;
        $this->description = $Category->description;
        $this->parent_id = $Category->parent_id;
        $this->idCate = $Category->id;
        $this->image = $Category->image;
    }

    public function resetInput()
    {
        $this->name = null;
        $this->description = null;
        $this->image = null;
        $this->parent_id = null;
        $this->isEdit = false;
        $this->idCate = null;
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
}
