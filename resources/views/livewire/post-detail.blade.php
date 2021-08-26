<div>
  <div class="p-4 p-md-5 mb-4 mt-4 text-white rounded bg-dark">
    <div class="col-12 px-0">
      <h1 class="display-4 text-center fst-italic">{{ $post->name }}</h1>
    </div>
  </div>
  <div class="row g-5">
    <div class="col-lg-10">
      <div wire:ignore>
        @livewire('component.post-detail', ['post' => $post])
      </div>
      <div class="row d-flex justify-content-between">
        <div class="col-3">
          @if($post->prevPost)
            <a
              href="{{ route('detail', ['id' => $post->prevPost->id, 'slug' => $post->prevPost->slug ]) }}"
              class="btn btn-primary btn-sm text-white text-decoration-none w-100"
            >Bài trước</a>
          @endif
        </div>
        <div class="col-3">
          @if($post->nextPost)
            <a
              href="{{ route('detail', ['id' => $post->nextPost->id, 'slug' => $post->nextPost->slug ]) }}"
              class="btn btn-primary btn-sm text-white text-decoration-none w-100"
            >Bài tiếp theo</a>
          @endif
        </div>
      </div>
      <hr>
      <div>
        <div class="row col-lg-12 mb-3">
          <h3>Top views</h3>
          @foreach($mostPosts as $mostPost)
            <div class="col-lg-3" :wire:key="$loop->index">
              @livewire('component.card-post', ['post' => $mostPost], key($loop->index))
            </div>
          @endforeach
        </div>
        <hr>
        <div class="row col-lg-12 mb-3" id="loadPost">
          <h3>Liên quan </h3>
          @foreach($relates as $rela)
            <div class="col-lg-3">
              @livewire('component.card-post', ['post' => $rela], key($loop->index))
            </div>
          @endforeach
        </div>
      </div>
    </div>
    <div class="col-lg-2 d-block d-lg-block d-md-none d-sm-none d-none" wire:ignore>
      <div class="position-sticky" style="top: 2rem; height: 100vh; overflow-y: auto;">
        <div class="mt-3">
          <h4 class="fst-italic">Mục lục</h4>
          <div id="render-list"></div>
        </div>
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
    }(document, 'script', 'facebook-jssdk'));
    $(document).ready(function () {
      console.log($('#loadPost').offset().top)
      let isLoaded = false
      $(window).scroll(function() {
        if($(this).scrollTop() + $(window).height() >= $('#loadPost').offset().top) {
          if (!isLoaded) {
            Livewire.emit('loadPost');
            isLoaded = true;
          }
        }
      });
    })
  </script>
@endpush
