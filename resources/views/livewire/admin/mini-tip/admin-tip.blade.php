@section('styles')
  <link rel="stylesheet" href="{{ mix('admin/simplemde.min.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/highlight.js/latest/styles/github.min.css">
  <style>
    .CodeMirror-fullscreen {
      z-index: 9999;
    }

    .CodeMirror {
      height: 400px;
    }

    .CodeMirror,
    .CodeMirror-scroll {
      min-height: 200px;
    }
  </style>
@stop
<div class="container-fluid px-4">
  <h1 class="mt-4">Tip</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="index.html">Tip</a></li>
    <li class="breadcrumb-item active">Create</li>
  </ol>
  <div class="card mb-4">
    <div class="p-2 card-body d-flex flex-row-reverse">
      <a class="btn btn-primary btn-sm text-white" href="{{ route('mini_tips') }}"> <i class="bi bi-box-arrow-in-left"></i> Back </a>
    </div>
  </div>
  <div class="card mb-4">
    <form class="row g-3 p-3" method="post" wire:submit.prevent="{{ $action }}">
      @csrf
      @livewire('component.upload-content-file')
      <div class="col-md-6">
        <label for="name" class="form-label">Tiêu đề</label>
        <input type="text" class="form-control" id="name" name="name" wire:model.debounce.500ms="tip.title">
        @error('tip.name') <span class="text-danger fs-6 fw-light"> {{ $message }} </span> @enderror
      </div>
      <div class="col-md-6">
        <label for="lang" class="form-label">Lang</label>
        <select class="form-control" id="lang" name="lang" wire:model.debounce.500ms="tip.lang">
          @foreach(config('data.lang') as $lang)
            <option value="{{ $lang }}">{{ $lang }}</option>
          @endforeach
        </select>
        @error('tip.lang') <span class="text-danger fs-6 fw-light"> {{ $message }} </span> @enderror
      </div>
      <div class="col-12" wire:ignore>
        <label for="content" class="form-label">Content</label>
        @error('tip.content') <span class="text-danger fs-6 fw-light"> {{ $message }} </span> @enderror
        <textarea class="form-control" id="content" name="content" wire:key="tip.content" wire:model.debounce.500ms="tip.content" placeholder="Cú pháp Markdown được hỗ trợ. Nhấp vào ？ để xem hướng dẫn
Để xuống dòng, sử dụng thẻ &lt;br&gt; hoặc nhấn Enter hai lần
Nhấp vào 👁 hoặc nhấn 'Ctrl + P' bật/tắt chế độ xem trước
Nhấp vào ▯▯ hoặc nhấn F9 để bật/tắt chế độ xem trước song song với soạn thảo
Nhấp vào 🕂 hoặc nhấn F11 để  bật/tắt chế độ toàn màn hình
Để highlight các đoạn code, hãy viết thêm tên viết thường của ngôn ngữ sau ba dấu gạch ngược (ví dụ: ```ruby)"></textarea>
      </div>
      <div class="col-12">
        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">{{ $tip->id ? 'Cập nhật' : 'Tạo mới' }}</button>
      </div>
    </form>
  </div>
</div>
@section('scripts')
  <script src="{{ mix('admin/simplemde.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/highlight.js/latest/highlight.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
  <script>
    $(document).ready(function() {
      var simplemde = new SimpleMDE({
        autofocus: true,
        element: document.getElementById("content"),
        forceSync: true,
        hideIcons: ["guide", "heading"],
        indentWithTabs: true,
        insertTexts: {
          horizontalRule: ["", "\n\n-----\n\n"],
          image: ["![](http://", ")"],
          link: ["[", "](http://)"],
          table: ["", "\n\n| Column 1 | Column 2 | Column 3 |\n| -------- | -------- | -------- |\n| Text     | Text      | Text     |\n\n"],
        },
        lineWrapping: false,
        parsingConfig: {
          allowAtxHeaderWithoutSpace: true,
          strikethrough: false,
          underscoresBreakWords: true,
        },
        promptURLs: true,
        renderingConfig: {
          singleLineBreaks: true,
          codeSyntaxHighlighting: true,
        },
        shortcuts: {
          drawTable: "Cmd-Alt-T"
        },
        showIcons: ["code", "table"],
        spellChecker: false,
        status: true,
        indentWithTabs: true,
        styleSelectedText: false,
        tabSize: 2,
        toolbarTips: true,
        toolbar: [{
          name: "bold",
          action: SimpleMDE.toggleBold,
          className: "fa fa-bold",
          title: "Bold",
        },
          {
            name: "heading-1",
            action: SimpleMDE.toggleHeading1,
            className: "fa fa-header fa-header-x fa-header-1",
            title: "Bold",
          },
          {
            name: "heading-2",
            action: SimpleMDE.toggleHeading2,
            className: "fa fa-header fa-header-x fa-header-2",
            title: "Bold",
          },
          {
            name: "heading-3",
            action: SimpleMDE.toggleHeading3,
            className: "fa fa-header fa-header-x fa-header-3",
            title: "Bold",
          },
          "|",
          {
            name: "table",
            action: SimpleMDE.drawTable,
            className: "fa fa-table",
            title: "Tạo bảng",
          },
          {
            name: "link",
            action: SimpleMDE.drawLink,
            className: "fa fa-link no-mobile",
            title: "Create Link",
          },
          "|",
          {
            name: "image",
            action: () => $('#hidden-input-file').click(),
            className: "fa fa-image",
            title: "Upload Image",
          },
          {
            name: "preview",
            action: SimpleMDE.togglePreview,
            className: "fa fa-eye no-disable",
            title: "Toggle Preview",
          },
          {
            name: "side-by-side",
            action: SimpleMDE.toggleSideBySide,
            className: "fa fa-columns no-disable no-mobile",
            title: "Toggle Side by Side",
          },
          {
            name: "fullscreen",
            action: SimpleMDE.toggleFullScreen,
            className: "fa fa-arrows-alt no-disable no-mobile",
            title: "Toggle Fullscreen",
          },

        ]
      });

      let typingTimer;
      simplemde.codemirror.on('keyup', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(doneTyping, 1000);
      });

      simplemde.codemirror.on('keydown', function() {
        clearTimeout(typingTimer);
      });

      function doneTyping() {
        Livewire.emit('contentUpdated', simplemde.value())
      }
    });
  </script>
@stop
