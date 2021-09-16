<?php

namespace App\Http\Livewire\Admin;
use Spatie\Analytics\Period;
use Analytics;

class Dashboard extends BaseComponent
{
    protected string $view = 'livewire.admin.dashboard';

    public int $mostVisited = 7;

    public function render()
    {
        $mostVisit = $this->fetchMostVisited();
        $topReferrers = $this->fetchTopReferrers();

        return view('livewire.admin.dashboard', compact('mostVisit', 'topReferrers'))
            ->extends($this->extends)
            ->section($this->section);
    }


    public function updatedMostVisited()
    {
        $data = $this->fetchMostVisited()->toArray();
        $this->emit('updateMostVisited', [
            'chart_id' => 'mostVisited',
            'data' => $data,
        ]);
    }

    private function fetchMostVisited()
    {
        return Analytics::fetchMostVisitedPages(Period::days($this->mostVisited), 10);
    }

    private function fetchTopReferrers()
    {
        return Analytics::fetchTopReferrers(Period::months(1), 10);
    }
}
