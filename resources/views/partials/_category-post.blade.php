@foreach($categories as $category)
  <section class="text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">{{ $category->name }} ({{ $category->posts->count() }} posts)</h1>
      </div>
    </div>
  </section>
  <div class="pt-5 pb-lg-3 row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-3">
    @foreach($category->posts as $post)
      <livewire:card-post :post="$post"/>
    @endforeach
  </div>

  @if($category->posts_count > $numPost)
    <div class="d-flex justify-content-center">
      <a href="{{ route('category', $category->id) }}" class="text-center"> Xem thêm </a>
    </div>
  @endif
@endforeach
