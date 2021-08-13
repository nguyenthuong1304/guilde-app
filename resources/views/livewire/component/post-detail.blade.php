@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/highlight.js/latest/styles/github.min.css">
@stop
<div>
  <div class="card mb-4">
    <div class="p-2 card-body">
      {!! nl2br(e($post->description)) !!}
    </div>
  </div>
  <div id="render" data-markdown="{{ $post->content }}"></div>
</div>
@section('scripts')
<script src="{{ asset('js/markdown-it.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/highlight.min.js"></script>
<script>
  $(document).ready(function() {
    var md = window.markdownit({
      // html: true,
      // linkify: true,
      // typographer: true,
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
    $('#render').attr('data-markdown', '')
    $('#render').html(result)
  });
</script>
@stop
