<div class="p-4 p-md-5 mb-4 mt-4 text-white rounded bg-dark">
  <div class="col-12 px-0">
    <h1 class="display-4 fst-italic">{{ $post->name }}</h1>
{{--    <p class="lead my-3">--}}
{{--      Multiple lines of text that form the lede, informing new readers quickly and efficiently about what’s most interesting in this post’s contents.--}}
{{--    </p>--}}
  </div>
</div>
{{--<div class="row mb-2">--}}
{{--  <div class="col-md-6">--}}
{{--    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">--}}
{{--      <div class="col p-4 d-flex flex-column position-static">--}}
{{--        <strong class="d-inline-block mb-2 text-primary">World</strong>--}}
{{--        <h3 class="mb-0">Featured post</h3>--}}
{{--        <div class="mb-1 text-muted">Nov 12</div>--}}
{{--        <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>--}}
{{--        <a href="#" class="stretched-link">Continue reading</a>--}}
{{--      </div>--}}
{{--      <div class="col-auto d-none d-lg-block">--}}
{{--        <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">--}}
{{--          <title>Placeholder</title>--}}
{{--          <rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>--}}
{{--        </svg>--}}
{{--      </div>--}}
{{--    </div>--}}
{{--  </div>--}}
{{--  <div class="col-md-6">--}}
{{--    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">--}}
{{--      <div class="col p-4 d-flex flex-column position-static">--}}
{{--        <strong class="d-inline-block mb-2 text-success">Design</strong>--}}
{{--        <h3 class="mb-0">Post title</h3>--}}
{{--        <div class="mb-1 text-muted">Nov 11</div>--}}
{{--        <p class="mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>--}}
{{--        <a href="#" class="stretched-link">Continue reading</a>--}}
{{--      </div>--}}
{{--      <div class="col-auto d-none d-lg-block">--}}
{{--        <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">--}}
{{--          <title>Placeholder</title>--}}
{{--          <rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>--}}
{{--        </svg>--}}

{{--      </div>--}}
{{--    </div>--}}
{{--  </div>--}}
{{--</div>--}}

<div class="row g-5">
  <div class="col-md-10">
    @livewire('component.post-detail', ['post' => $post])
  </div>

  <div class="col-md-2">
    <div class="position-sticky" style="top: 2rem;">
{{--      <div class="p-4 mb-3 bg-light rounded">--}}
{{--        <h4 class="fst-italic">About</h4>--}}
{{--        <p class="mb-0">Customize this section to tell your visitors a little bit about your publication, writers, content, or something else entirely. Totally up to you.</p>--}}
{{--      </div>--}}

      <div class="">
        <h4 class="fst-italic">Kế tiếp</h4>
        <ol class="list-unstyled mb-0">
          @foreach($relates as $postR)
            <li><a href="{{ route('detail', $postR->slug) }}"> {{ $postR->name }}</a></li>
          @endforeach
        </ol>
      </div>

      <div class="">
        <h4 class="fst-italic">Elsewhere</h4>
        <ol class="list-unstyled">
          <li><a href="#">GitHub</a></li>
          <li><a href="#">Twitter</a></li>
          <li><a href="#">Facebook</a></li>
        </ol>
      </div>
    </div>
  </div>
</div>
