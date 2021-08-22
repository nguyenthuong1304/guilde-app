<div class="col" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $post->name }}">
  <div class="card shadow-sm">
    <a href="{{ route('detail', ['id' => $post->id, 'slug' => $post->slug ]) }}" class="text-decoration-none">
      <div class="card-body rounded-3">
        <p class="card-text text-dots">{{ $post->name }}</p>
        <small class="text-muted"> Ngày Tạo: {{ $post->created_at->format('d/m/Y') }}</small><br>
        <i class="bi bi-eye"></i> {{ $post->views}} Lượt xem
      </div>
    </a>
  </div>
</div>
