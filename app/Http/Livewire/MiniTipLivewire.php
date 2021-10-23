<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MiniTipLivewire extends Component
{
    public function render()
    {
        return view('livewire.mini-tip-livewire')
            ->extends('layouts.tip-layout')
            ->section('main');
    }
}
