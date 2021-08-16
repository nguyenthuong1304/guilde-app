@extends('layouts.app')
@section('main')
  <section class="text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">{{ $category->name }} ({{ $category->posts->count() }} posts)</h1>
      </div>
    </div>
  </section>
    @if($category->posts->count())
      <div class="pt-5 pb-lg-3 row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-3">
        @foreach($category->posts as $post)
          <livewire:card-post :post="$post"/>
        @endforeach
      </div>
    @else
      <h1 class="text-center">Chưa có bài viết nào</>
    @endif

    @if($category->children->count())
      <div class="separator"><h3>Danh mục con</h3></div>
      @include('partials._category-post', ['categories' => $category->children, 'numPost' => 5])
    @endif
@stop
