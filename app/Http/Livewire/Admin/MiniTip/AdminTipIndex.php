<?php

namespace App\Http\Livewire\Admin\MiniTip;

use App\Http\Livewire\Admin\BaseComponent;
use App\Models\MiniTip;
use Livewire\WithPagination;

class AdminTipIndex extends BaseComponent
{
    use WithPagination;

    public function render()
    {
        return view('livewire.admin.mini-tip.index', [
            'tips' => MiniTip::paginate($this->perPage),
        ])
            ->extends($this->extends)
            ->section($this->section);
    }
}
