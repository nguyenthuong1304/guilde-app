<?php

namespace App\Http\Livewire\Admin;
use Spatie\Analytics\Period;
use Analytics;
use Carbon\Carbon;

class Dashboard extends BaseComponent
{
    protected string $view = 'livewire.admin.dashboard';

    public int $mostVisited = 7;

    public function render()
    {
        $mostVisit = $this->fetchVisitorsAndPageViews();
        $topReferrers = $this->fetchTopReferrers();
        $topBrowsers = $this->fetchTopBrowsers();

        return view('livewire.admin.dashboard', compact('mostVisit', 'topReferrers', 'topBrowsers'))
            ->extends($this->extends)
            ->section($this->section);
    }


    public function updatedMostVisited()
    {
        $data = $this->fetchVisitorsAndPageViews()->toArray();

        $this->emit('updateMostVisited', [
            'chart_id' => 'mostVisited',
            'data' => $data,
        ]);
    }

    // private function fetchMostVisited()
    // {
    //     return Analytics::fetchVisitorsAndPageViews(Period::days($this->mostVisited), 10);
    // }

    private function fetchTopReferrers()
    {
        return Analytics::fetchTopReferrers(Period::months(1), 10);
    }

    private function fetchTopBrowsers() {
        return Analytics::fetchTopBrowsers(Period::months(1), 10);
    }

    public function fetchVisitorsAndPageViews()
    {
        $response = Analytics::performQuery(
            Period::days(30),
            'ga:users,ga:pageviews,ga:sessions',
            [
                'dimensions' => 'ga:date,ga:pageTitle',
                'sort' => '-ga:pageviews',
                'max-results' => 10,
            ],
        );

        return collect($response['rows'] ?? [])->map(fn (array $dateRow) => [
            'pageTitle' => $dateRow[1],
            'visitors' => (int) $dateRow[2],
            'pageViews' => (int) $dateRow[3],
            'sessions' => (int) $dateRow[4],
        ]);
    }
}
