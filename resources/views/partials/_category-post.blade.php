@foreach($categories as $category)
  <section class="text-center container">
    <div class="row pt-3">
      <div class="">
        <hr>
        <h3 class="fw-light">
          <a class="text-decoration-none text-dark" href="{{ route('category', $category->id) }}">
            {{ $category->name }} ( {{ $category->posts->count() }} posts @if($category->children_count)- {{ $category->children_count }} Danh mục con @endif)
          </a>
          <hr>
        </h3>
      </div>
    </div>
  </section>
  <div class="pt-5 pb-lg-3 row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-3">
    @foreach($category->posts as $post)
      <livewire:component.card-post :post="$post"/>
    @endforeach
  </div>

  @if($category->posts_count > $numPost)
    <div class="d-flex justify-content-center">
      <a href="{{ route('category', $category->id) }}" class="text-center"> Xem thêm </a>
    </div>
  @endif
@endforeach
