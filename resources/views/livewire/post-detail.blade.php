<div class="p-4 p-md-5 mb-4 mt-4 text-white rounded bg-dark">
  <div class="col-12 px-0">
    <h1 class="display-4 text-center fst-italic">{{ $post->name }}</h1>
  </div>
</div>
<div class="row g-5">
  <div class="col-lg-10">
    @livewire('component.post-detail', ['post' => $post])
  </div>

  <div class="col-lg-2 d-block d-lg-block d-md-none d-sm-none d-none">
    <div class="position-sticky" style="top: 2rem;">
      <div class="mt-3">
        <h4 class="fst-italic">Mục lục</h4>
        <div id="render-list"></div>
      </div>

      <div class="">
        <h4 class="fst-italic">Kế tiếp</h4>
        <ol class="list-unstyled mb-0">
          @foreach($relates as $postR)
            <li><a href="{{ route('detail', $postR->slug) }}"> {{ $postR->name }}</a></li>
          @endforeach
        </ol>
      </div>
    </div>
  </div>
</div>
