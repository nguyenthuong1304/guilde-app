<div class="search-wrapper @if($term) focused @endif">
  <div wire:ignore>
    <input class="btn search-input dropdown-toggle" type="text" placeholder="Search" wire:model.debounce.800ms="term" />
    <div wire:loading.grid>
      <i class="bi bi-arrow-repeat"></i>
    </div>
    <div wire:loading.remove>
      <i class="bi bi-search"></i>
    </div>
  </div>
  @if ($term)
    <ul class="dropdown-menu show" aria-labelledby="dropdownMenuButton1">
      @if($posts->count())
        @foreach($posts as $post)
          <li><a class="dropdown-item text-dots p-2" href="{{ route('detail', $post->slug) }}">{{ $post->name }}</a></li>
        @endforeach
        @if($posts->hasMorePages())
          <hr>
          <li><a class="dropdown-item text-center" href="{{ route('search', ['term' => $term]) }}">Xem thêm</a></li>
        @endif
      @else
        <li><a class="dropdown-item" href="javascript:void(0)">Nothing to show</a></li>
      @endif
    </ul>
  @endif
</div>
@push('scripts')
<script>
    let searchWrapper = document.querySelector('.search-wrapper'),
      searchInput = document.querySelector('.search-input');
    document.addEventListener('click', e => {
      if (~e.target.className.indexOf('search')) {
        searchWrapper.classList.add('focused');
        searchInput.focus();
        $('.search-wrapper .dropdown-menu').addClass('show');
      } else {
        $('.search-wrapper .dropdown-menu').removeClass('show');
        if (!searchInput.value.length) {
          searchWrapper.classList.remove('focused');
        }
      }
    });
  </script>
@endpush
