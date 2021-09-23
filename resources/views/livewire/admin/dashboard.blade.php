<div class="container-fluid px-4">
  <h1 class="mt-4">Thống kê</h1>
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
  <div class="card mb-4">
    <div class="card-header d-flex justify-content-between">
      <div><i class="fas fa-table me-1"></i>Top 20 thiết bị có lượt truy cập nhiều nhấy hôm nhất tuần qua</div>
    </div>
    <div class="card-body" id="mostVisited-div">
      <div
        class="dataTable-container"
        wire:loading.class="overlay"
        wire:target="search"
      >
        <table id="datatablesSimple" class="dataTable-table table-responsive justify-content-center">
          <thead>
          <tr>
            <th class="text-center">
              <a href="#"> Thông tin thiết bị </a>
            </th>
            <th class="text-center">
              <a href="#"> Nguồn </a>
            </th>
            <th class="text-center">
              <a href="#">Phiên</a>
            </th>
            <th class="text-center">
              <a href="#">Page views</a>
            </th>
            <th class="text-center">
              <a href="#">Thời gian mobileDeviceInfo</a>
            </th>
          </tr>
          </thead>
          <tbody>
          @foreach($topDevices as $item)
            <tr :wire:key="{{ $item['mobileDeviceInfo'] }}">
              <td>{{ $item['mobileDeviceInfo'] }}</td>
              <td class="text-center">{{ $item['source'] }}</td>
              <td class="text-center">{{ $item['sessions'] }}</td>
              <td class="text-center">{{ $item['pageviews'] }}</td>
              <td class="text-center">{{ $item['sessionDuration'] }}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@section('scripts')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    window.livewire.on('updateMostVisited', ({ chart_id, data }) => {
      window[chart_id].data.datasets.forEach((dataset, key) => {
        dataset.data = data.map(item => [
          item.url,
          item.pageViews
        ][key]);
      });
      window[chart_id].data.labels = data.map(item => item.pageTitle);

      window[chart_id].update();
    });
  </script>
@stop
