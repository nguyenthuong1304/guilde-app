<?php

namespace App\Http\Livewire\Component;

use Illuminate\Support\Collection;
use Livewire\Component;

class Select extends Component
{
    public string|array $optChooses;
    public string $key, $value, $classNameAjax;
    public bool $isMulti, $isAjax;
    public Collection|array|null $objects = [];

    public function mount(
        $key = 'id',
        $value = 'name',
        $objects = [],
        $isMulti = false,
        $isAjax = false,
        $classNameAjax = '',
        $optChooses = [],
    ) {
        $this->key = $key;
        $this->value = $value;
        $this->objects = $objects;
        $this->isMulti = $isMulti;
        $this->optChooses = $optChooses;
        $this->isAjax = $isAjax;
        $this->classNameAjax = $classNameAjax;
    }

    public function updatedOptChooses($val)
    {
        $this->emit('selected', $val);
    }

    public function render()
    {
        return view('livewire.component.select');
    }
}
