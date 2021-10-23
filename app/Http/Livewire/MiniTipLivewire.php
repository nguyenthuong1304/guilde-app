<?php

namespace App\Http\Livewire;

use App\Models\MiniTip;
use Livewire\Component;

class MiniTipLivewire extends Component
{
    public MiniTip $tip;

    public function mount()
    {
        $this->tip = MiniTip::inRandomOrder()->first();
    }

    public function render()
    {
        return view('livewire.mini-tip-livewire',[
            'tip' => $this->tip,
        ])
            ->extends('layouts.tip-layout')
            ->section('main');
    }
}
