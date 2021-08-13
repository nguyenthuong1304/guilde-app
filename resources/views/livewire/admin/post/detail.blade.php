@extends('layouts.admin.app')
@section('main')
<div class="container-fluid px-4">
  <h1 class="mt-4">Post</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="index.html"> {{ $post->name }} </a></li>
    <li class="breadcrumb-item active">{{ $post->slug }} ({{ $post->category->name }}) </li>
  </ol>
  <div class="card mb-4">
    <div class="p-2 card-body d-flex flex-row-reverse">
      <a class="btn btn-primary btn-sm text-white" href="{{ route('post_index') }}"> <i class="bi bi-back"></i> Back </a>
    </div>
  </div>
  <div class="card mb-4">
    <div class="card-body">
      @livewire('component.post-detail', ['post' => $post])
    </div>
  </div>
</div>
@stop
