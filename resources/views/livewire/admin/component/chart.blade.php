<div wire:ignore wire:key={{ $chartId }}>
  <canvas id="{{ $chartId }}" height="{{ $height }}"></canvas>
</div>

@push('scripts')
  <script>
    const {{$chartId}}_data = {
      labels: @json($labels),
      datasets: @json($datasets)
    };

    const {{$chartId}}_config = {
      type: '{{ $type }}',
      data: {{$chartId}}_data,
      options: @json($options)
    };

    var {{$chartId}} = new Chart(
      document.getElementById('{{ $chartId }}'),
      {{$chartId}}_config
    );
  </script>
@endpush
