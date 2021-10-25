<?php

namespace App\Http\Livewire\Admin\MiniTip;

use App\Http\Livewire\Admin\BaseComponent;
use App\Models\MiniTip;
use Illuminate\Validation\Rule;

class AdminTip extends BaseComponent
{
    public MiniTip $tip;
    public array $rules = [];
    protected $listeners = [
        'contentUpdated' => 'setContent',
    ];

    public function mount($id = null)
    {
        $this->tip = MiniTip::findOrNew($id);
    }

    public function render()
    {
        return view('livewire.admin.mini-tip.admin-tip', [
            'tip' => $this->tip,
            'action' => 'store',
        ])
        ->extends($this->extends)
        ->section($this->section);
    }

    public function store()
    {
        $this->validate();
        try {
            $this->tip->save();
            session()->flash('message', ['type' => 'success', 'message' => 'Create post successfully']);
            $this->redirectRoute('mini_tips');
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function rules()
    {
        $id = $this->tip->id ?? 0;

        return [
            'tip.title' => 'required|string|min:5|max:100|unique:mini_tips,title,'.$id,
            'tip.lang' => 'required|' . Rule::in(config('data.lang')),
            'tip.content' => 'nullable|string|max:2000',
        ];
    }

    public function setContent($val): void
    {
        $this->tip->content = $val;
    }
}
