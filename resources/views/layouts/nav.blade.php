<div class="nav-scroller py-1 mb-2">
  <nav class="nav d-flex justify-content-between">
    @foreach($categories as $cate)
      <div class="dropdown main-cate" data-bs-toggle="dropdown" aria-expanded="false">
        <a class="p-2 dropdown-item link-secondary" href="{{ route('category', $cate) }}"> {{ $cate->name}} </a>
        @if($cate->children->count())
        <ul class="dropdown-menu">
          @foreach($cate->children as $cateC)
            <li>
              <a class="p-2 dropdown-item link-secondary" href="{{ route('category', $cateC) }}"> {{ $cateC->name}} </a>
            </li>
          @endforeach
        </ul>
        @endif
      </div>
    @endforeach
  </nav>
</div>
<div class="rounded banner mb-3">
  <img src="{{ asset($config->banner ?? 'images/banner.jpeg') }}" alt="">
</div>
