<div class="nav-scroller py-1 mb-2">
  <nav class="nav d-flex justify-content-between">
    @foreach($categories as $cate)
    <a class="p-2 link-secondary" href="{{ route('category', $cate->id) }}"> {{ $cate->name}} </a>
    @endforeach
  </nav>
</div>
<div class="rounded banner">
  <img src="{{ asset('images/banner.jpeg') }}" alt="">
</div>
