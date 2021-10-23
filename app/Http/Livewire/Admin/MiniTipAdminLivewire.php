<?php

namespace App\Http\Livewire\Admin;

class MiniTipAdminLivewire extends BaseComponent
{
    public function render()
    {
        return view('livewire.admin.mini-tip-livewire')
            ->extends($this->extends)
            ->section($this->section);
    }
}
