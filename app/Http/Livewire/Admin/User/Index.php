<?php

namespace App\Http\Livewire\Admin\User;

use App\Http\Livewire\Admin\BaseComponent;
use App\Models\User;
use Livewire\WithPagination;

class Index extends BaseComponent
{
    use WithPagination;

    public string $orderBy = 'created_at';
    public string $order = 'asc';
    public string $search = '';

    public function mount()
    {
        $this->checkAccessAdmin();
    }

    public function render()
    {
        return view('livewire.admin.user.index', [
            'users' => User::where(function ($q) {
                $q->where('name', 'like', '%'.$this->search.'%');
            })
            ->orderBy($this->orderBy, $this->order)
            ->paginate($this->perPage),
        ])
        ->extends($this->extends)
        ->section($this->section);
    }
}
