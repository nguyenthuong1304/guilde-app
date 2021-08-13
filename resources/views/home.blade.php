@extends('layouts.app')
@section('main')
<section class="text-center container">
  <div class="row py-lg-5">
    <div class="col-lg-6 col-md-8 mx-auto">
      <h1 class="fw-light">{{ $data->name }}</h1>
    </div>
  </div>
</section>
<div class="py-5 row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-3">
  @foreach($data->posts as $post)
    <livewire:card-post :post="$post"/>
  @endforeach
</div>
@stop
