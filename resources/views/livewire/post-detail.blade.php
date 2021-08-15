<div class="p-4 p-md-5 mb-4 mt-4 text-white rounded bg-dark">
  <div class="col-12 px-0">
    <h1 class="display-4 fst-italic">{{ $post->name }}</h1>
  </div>
</div>
<div class="row g-5">
  <div class="col-md-10">
    @livewire('component.post-detail', ['post' => $post])
  </div>

  <div class="col-md-2">
    <div class="position-sticky" style="top: 2rem;">
      <div class="">
        <h4 class="fst-italic">Kế tiếp</h4>
        <ol class="list-unstyled mb-0">
          @foreach($relates as $postR)
            <li><a href="{{ route('detail', $postR->slug) }}"> {{ $postR->name }}</a></li>
          @endforeach
        </ol>
      </div>

      <div class="mt-3">
        <h4 class="fst-italic">Series</h4>
        <ol class="list-unstyled">
          <li><a href="#">GitHub</a></li>
          <li><a href="#">Twitter</a></li>
          <li><a href="#">Facebook</a></li>
        </ol>
      </div>
    </div>
  </div>
</div>
