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

    #render img {
      width: 100%;
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
      const renderEl = $('#render');
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
      var result = md.render(renderEl.data('markdown'));
      renderEl.attr('data-markdown', '');
      renderEl.html(result);
      $('.linear-background').addClass('d-none');
      const eleRenderList = $('#render-list');
      if (eleRenderList.length) {
        let newList = '<ol class="list-unstyled">';
        renderEl.find('img').attr('loading', 'lazy');
        renderEl.find('h1, h2, h3, h4, h5, h6').each((id, el) => {
          let idName = (Math.random() + 1).toString(36).substring(2);
          $(el).replaceWith(function () {
            let newTag, lv;
            switch (el.tagName) {
              case 'H1':
                newTag = 'h2';
                lv = '1';
              break;
              case 'H2':
                newTag = 'h3';
                lv = '2';
              break;
              case 'H3': newTag = 'h4'; break;
              case 'H4': newTag = 'h5'; break;
              case 'H5': newTag = 'h6'; break;
              default: newTag = 'p';
            }
            if (el.tagName === 'H1' || el.tagName == 'H2') {
              newList += `<li class="list-level-${lv}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="${$(el).html()}"><a href="#${idName}" class="text-decoration-none">${el.innerText}</a></li>`;
            }
            return `<${newTag} id="${idName}"> ${$(this).html()} </${newTag}>`;
          });
        });
        newList += '</ol>';
        eleRenderList.replaceWith(newList);
        $('[data-bs-toggle="tooltip"]').tooltip();
      }
    });
  </script>
@stop
