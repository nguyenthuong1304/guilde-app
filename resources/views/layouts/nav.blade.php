<div class="nav-scroller py-1 mb-2">
  <nav class="nav d-flex justify-content-between">
    @foreach($categories as $cate)
      <div class="dropdown main-cate">
        <a class="p-2 link-secondary" href="{{ route('category', $cate) }}"> {{ $cate->name}} </a>
        @if($cate->children->count())
        <div class="dropdown-menu">
          @foreach($cate->children as $cateC)
            <a class="p-2 link-secondary" href="{{ route('category', $cateC) }}"> {{ $cateC->name}} </a>
          @endforeach
        </div>
        @endif
      </div>
    @endforeach
  </nav>
</div>
<div class="rounded banner mb-3">
  <img src="{{ asset($config->banner ?? 'images/banner.jpeg') }}" alt="">
</div>
