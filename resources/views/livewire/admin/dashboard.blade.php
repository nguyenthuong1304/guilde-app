<div class="container-fluid px-4">
  <h1 class="mt-4">Dashboard</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Dashboard</li>
  </ol>
  <div class="row">
    <div class="col-xl-3 col-md-6">
      <div class="card bg-primary text-white mb-4">
        <div class="card-body">Primary Card</div>
        <div class="card-footer d-flex align-items-center justify-content-between">
          <a class="small text-white stretched-link" href="#">View Details</a>
          <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6">
      <div class="card bg-warning text-white mb-4">
        <div class="card-body">Warning Card</div>
        <div class="card-footer d-flex align-items-center justify-content-between">
          <a class="small text-white stretched-link" href="#">View Details</a>
          <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6">
      <div class="card bg-success text-white mb-4">
        <div class="card-body">Success Card</div>
        <div class="card-footer d-flex align-items-center justify-content-between">
          <a class="small text-white stretched-link" href="#">View Details</a>
          <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6">
      <div class="card bg-danger text-white mb-4">
        <div class="card-body">Danger Card</div>
        <div class="card-footer d-flex align-items-center justify-content-between">
          <a class="small text-white stretched-link" href="#">View Details</a>
          <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-6">
      <div class="card mb-4">
        <div class="card-header">
          <i class="fas fa-chart-area me-1"></i>
          TOP browser
        </div>
        <div class="card-body">
          @livewire('admin.component.chart', [
            'chartId' => 'topBrowsers',
            'type' => 'bar',
            'labels' => $topBrowsers->pluck('browser'),
            'datasets' => [[
              'label' => 'Sessions',
              'backgroundColor' => [
              'rgb(255, 99, 132)',
              'rgb(54, 162, 235)',
              ],
              'data' => $topBrowsers->pluck('sessions'),
            ]],
            'options' => ['x' => 1]
          ], key(2))
        </div>
      </div>
    </div>
    <div class="col-xl-6">
      <div class="card mb-4">
        <div class="card-header">
          <i class="fas fa-chart-bar me-1"></i>
          TOP referrers trong 1 tháng
        </div>
        <div class="card-body">
          @livewire('admin.component.chart', [
            'chartId' => 'topReferrers',
            'type' => 'doughnut',
            'labels' => $topReferrers->pluck('url'),
            'datasets' => [[
              'label' => 'topReferrers',
              'backgroundColor' => [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
              ],
              'data' => $topReferrers->pluck('pageViews'),
            ]],
            'options' => ['maintainAspectRatio' => false, 'responsive' => true]
          ], key(1))
        </div>
      </div>
    </div>
  </div>
  <div class="card mb-4" wire:ignore>
    <div class="card-header d-flex justify-content-between">
      <div><i class="fas fa-table me-1"></i>Top 15 bài có lượt visited cao nhất {{ $mostVisited }} ngày qua</div>
      <div>
        <select type="text" class="form-control form-control-sm" wire:model.debounce.500ms="mostVisited">
          <option value="7">7 Ngày</option>
          <option value="14">14 Ngày</option>
          <option value="21">21 Ngày</option>
          <option value="30">30 Ngày</option>
        </select>
      </div>
    </div>
    <div class="card-body" id="mostVisited-div">
      @livewire('admin.component.chart', [
        'height' => 75,
        'chartId' => 'mostVisited',
        'type' => 'line',
        'labels' => $mostVisit->pluck('pageTitle'),
        'datasets' => [
          [
            'label' => 'Page views',
            'backgroundColor' => 'rgb(255, 99, 132)',
            'borderColor' => 'rgb(255, 99, 132)',
            'data' => $mostVisit->pluck('pageViews'),
          ],
          [
            'label' => 'Visitors',
            'backgroundColor' => 'rgb(54, 162, 235)',
            'data' => $mostVisit->pluck('visitors'),
            'type' => 'bar',
          ],
          [
            'label' => 'Sessions',
            'backgroundColor' => 'rgba(153, 102, 255, 0.2)',
            'data' => $mostVisit->pluck('sessions'),
            'type' => 'bar',
          ]
        ],
        'options' => [
          'animations' => [
           'tension' => [
            'duration' => 1000,
            'easing' => 'linear',
            'from' => 1,
            'to' => 0,
            'loop' => true,
            ]
          ]
        ],
      ], key(3))
    </div>
  </div>
</div>

@section('scripts')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    window.livewire.on('updateMostVisited', ({ chart_id, data }) => {
      window[chart_id].data.datasets.forEach((dataset, key) => {
        dataset.data = data.map(item => [
          item.pageViews,
          item.visitors,
          item.sessions
        ][key]);
      });
      window[chart_id].data.labels = data.map(item => item.pageTitle);

      window[chart_id].update();
    });
  </script>
@stop
