<div class="col">
  <div class="card shadow-sm">
    <a href="{{ route('detail', ['id' => $post->id, 'slug' => $post->slug ]) }}" class="text-decoration-none">
      <div class="card-body rounded-3">
        <p class="card-text" style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">{{ $post->name }}</p>
        <small class="text-muted" >{{ $post->created_at }}</small>
      </div>
    </a>
  </div>
</div>
