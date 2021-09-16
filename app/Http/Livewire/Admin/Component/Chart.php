<?php

namespace App\Http\Livewire\Admin\Component;

use Illuminate\Support\Collection;
use Livewire\Component;

class Chart extends Component
{
    public string $chartId;
    public string $type;
    public ?int $height;
    public Collection|array $labels;
    public Collection|array $datasets;
    public mixed $options;

    public function mount(
        $chartId,
        $type,
        $labels,
        $datasets,
        $options,
        $height = null,
    ){
        $this->chartId = $chartId;
        $this->type = $type;
        $this->labels = $labels;
        $this->datasets = $datasets;
        $this->options = $options;
        $this->height = $height;
    }

    public function render()
    {
        return view('livewire.admin.component.chart', [
            'chartId' => $this->chartId,
            'type' => $this->type,
            'height' => $this->height,
            'labels' => $this->labels,
            'datasets' => $this->datasets,
            'options' => $this->options,
        ]);
    }
}
