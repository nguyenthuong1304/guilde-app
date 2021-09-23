<?php

namespace App\Http\Livewire\Admin;
use Spatie\Analytics\Period;
use Analytics;
use Carbon\Carbon;

class Dashboard extends BaseComponent
{
    protected string $view = 'livewire.admin.dashboard';

    public function render()
    {
        $topDevices = $this->fetchMostVisitedPages();
        $topReferrers = $this->fetchTopReferrers();
        $topBrowsers = $this->fetchTopBrowsers();

        return view('livewire.admin.dashboard', compact('topDevices', 'topReferrers', 'topBrowsers'))
            ->extends($this->extends)
            ->section($this->section);
    }


//    public function updatedMostVisited()
//    {
//        $data = $this->fetchMostVisitedPages()->toArray();
//
//        $this->emit('updateMostVisited', [
//            'chart_id' => 'mostVisited',
//            'data' => $data,
//        ]);
//    }

    private function fetchTopReferrers()
    {
        return Analytics::fetchTopReferrers(Period::months(1), 10);
    }

    private function fetchTopBrowsers() {
        return Analytics::fetchTopBrowsers(Period::months(1), 10);
    }

    public function fetchMostVisitedPages()
    {
        $response = Analytics::performQuery(
            Period::create(
                now()->subDays(7),
                now(),
            ),
            'ga:sessions,ga:pageviews,ga:sessionDuration',
            [
                'dimensions' => 'ga:mobileDeviceInfo,ga:source',
                'sort' => '-ga:source',
                'max-results' => 10,
            ],
            ['segment' => 'gaid::-14']
        );

        return collect($response['rows'] ?? [])->map(fn (array $pageRow) => [
            'mobileDeviceInfo' => $pageRow[0],
            'source' => $pageRow[1],
            'sessions' => (int) $pageRow[2],
            'pageviews' => (int) $pageRow[3],
            'sessionDuration' => (int) $pageRow[4],
        ]);
    }
}
