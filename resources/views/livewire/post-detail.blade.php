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
    <div class="position-sticky" style="top: 2rem; height: 100vh; overflow-y: auto;">
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
@push('scripts')
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
@endpush
