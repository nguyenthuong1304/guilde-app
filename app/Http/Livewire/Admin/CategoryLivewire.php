<?php

namespace App\Http\Livewire\Admin;

use App\Traits\MixedComponent;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class CategoryLivewire extends BaseComponent
{
    use WithPagination, WithFileUploads, MixedComponent;

    protected string $view = 'livewire.admin.category.index';
    public $deleteId = null;
    public $name, $description, $image, $parent_id = null;
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updated($field)
    {
        $this->validateOnly($field, [
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|file|mimes:jpeg,jpg,png|max:4000',
            'parent_id' => 'nullable|exists:category,id,deleted_at,null',
        ]);
    }

    public function render()
    {
        return view('livewire.admin.category.index', [
            'objects' => Category::where('name', 'like', '%'.$this->search.'%')->paginate($this->perPage),
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

    public function save()
    {
        try {
            $this->image = Storage::putFile('category', $this->image);
            $this->cateService->save([
                'name' => $this->name,
                'description' => $this->description,
                'parent_id' => $this->parent_id,
                'image' => $this->image,
            ]);
            $this->resetInput();
            $this->emit('alert', [
                'success',
                'Create category success'
            ]);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function resetInput()
    {
        $this->name = null;
        $this->description = null;
        $this->file = null;
        $this->parent_id = null;
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
