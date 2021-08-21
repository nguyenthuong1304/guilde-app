@section('styles')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/highlight.js/latest/styles/github.min.css">
  <style>
    #render>thead,
    tbody,
    tfoot,
    tr,
    td,
    th {
      border: 1px solid #ddd !important;
      padding: 5px;
    }

    #render th {
      text-align: center;
    }

    #render td a {
      text-decoration: none;
    }

    @keyframes placeHolderShimmer{
      0%{
        background-position: -500px 0
      }
      100%{
        background-position: 500px 0
      }
    }
    .linear-background {
      animation-duration: 1s;
      animation-fill-mode: forwards;
      animation-iteration-count: infinite;
      animation-name: placeHolderShimmer;
      animation-timing-function: linear;
      background: #f6f7f8;
      background: linear-gradient(to right, #eeeeee 8%, #dddddd 18%, #eeeeee 33%);
      background-size: 1000px 104px;
      height: 100vh;
      position: relative;
      overflow: hidden;
    }
  </style>
@stop

<div>
  <div class="row">
    <div class="d-flex justify-content-end bd-highlight fs-5">
      <div class="p-2 bd-highlight">
        <a href="javascript:void(0)" class="text-decoration-none" title="Lượt xem"><i class="bi bi-eye"></i> {{ $post->views}}</a>
      </div>
      <div class="p-2 bd-highlight">
        <a href="javascript:void(0)" class="text-decoration-none" title="Coming soon"><i class="bi bi-bookmark-check"></i> 0</a>
      </div>
      @if(request()->route()->getName() == 'detail')
        <div class="p-1 bd-highlight">
          <div class="fb-share-button" data-href="{{ request()->url() }}" data-layout="button"></div>
        </div>
      @endif
    </div>
  </div>
  <div class="card mb-4">
    <div class="p-2 card-body">
      {!! nl2br(e($post->description)) !!}
    </div>
  </div>
  <div class="linear-background"></div>
  <div class="mb-2" id="render" class="d-none" data-markdown="{{ $post->content }}"></div>
  <div class="mb-4">
    @foreach($post->tags as $tag)
      <a href="{{ route('search') }}?tag_id={{ $tag->id }}" class="tags">
        {{ $tag->name }}
      </a>
    @endForeach
  </div>
</div>
@section('scripts')
  <script src="{{ asset('js/markdown-it.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/highlight.min.js"></script>
  <script>
    $(document).ready(function() {
      var md = window.markdownit({
        html: true,
        linkify: true,
        typographer: true,
        quotes: '“”‘’',
        xhtmlOut: false,
        langPrefix: 'language-',
        highlight: function(str, lang) {
          if (lang && hljs.getLanguage(lang)) {
            try {
              return '<pre class="hljs border"><code>' +
                hljs.highlight(str, {
                  language: lang,
                  ignoreIllegals: true
                }).value +
                '</code></pre>';
            } catch (__) {}
          }

          return '<pre class="hljs"><code>' + md.utils.escapeHtml(str) + '</code></pre>';
        }
      });
      var result = md.render($('#render').data('markdown'));
      $('#render').attr('data-markdown', '');
      $('#render').html(result);
      $('.linear-background').addClass('d-none');
      const eleRenderList = $('#render-list');
      if (eleRenderList.length) {
        let newList = '<ol class="list-unstyled">';
        $('#render').find('h1, h2').each((id, el) => {
          let lv = el.tagName === 'H1' ? '1' : '2';
          let className = (Math.random() + 1).toString(36).substring(2);
          $(el).attr('id', className);
          newList += `<li class="list-level-${lv}"><a href="#${className}" class="text-decoration-none">${el.innerText}</a></li>`;
        });
        newList += '</ol>';
        eleRenderList.replaceWith(newList);
      }
    });
  </script>
@stop
