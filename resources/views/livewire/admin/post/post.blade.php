@section('styles')
<link rel="stylesheet" href="{{ mix('admin/simplemde.min.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/highlight.js/latest/styles/github.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
  <h1 class="mt-4">Post</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="index.html">Post</a></li>
    <li class="breadcrumb-item active">Create</li>
  </ol>
  <div class="card mb-4">
    <div class="p-2 card-body d-flex flex-row-reverse">
      <a class="btn btn-primary btn-sm text-white" href="{{ route('post_index') }}"> <i class="bi bi-box-arrow-in-left"></i> Back </a>
    </div>
  </div>
  <div class="card mb-4">
    <form class="row g-3 p-3" method="post" wire:submit.prevent="{{$action}}">
      @csrf
      @livewire('component.upload-content-file')
      <div class="col-md-6">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" wire:model.debounce.500ms="post.name" wire:change="updateSlug($event.target.value)">
        @error('post.name') <span class="text-danger fs-6 fw-light"> {{ $message }} </span> @enderror
      </div>
      <div class="col-md-6">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" class="form-control" id="slug" name="slug" wire:model.debounce.500ms="post.slug">
        @error('post.slug') <span class="text-danger fs-6 fw-light"> {{ $message }} </span> @enderror
      </div>
      <div class="col-12">
        <label for="description" class="form-label">Description</label>
        <textarea rows="5" type="text" class="form-control" id="description" wire:model.debounce.500ms="post.description" placeholder="Description"></textarea>
        @error('post.description') <span class="text-danger fs-6 fw-light"> {{ $message }} </span> @enderror
      </div>
      <div class="col-12" wire:ignore>
        <label for="content" class="form-label">Content</label>
        @error('post.content') <span class="text-danger fs-6 fw-light"> {{ $message }} </span> @enderror
        <textarea class="form-control" id="content" name="content" wire:key="post.content" wire:model.debounce.500ms="post.content" placeholder="Cú pháp Markdown được hỗ trợ. Nhấp vào ？ để xem hướng dẫn
Để xuống dòng, sử dụng thẻ &lt;br&gt; hoặc nhấn Enter hai lần
Nhấp vào 👁 hoặc nhấn 'Ctrl + P' bật/tắt chế độ xem trước
Nhấp vào ▯▯ hoặc nhấn F9 để bật/tắt chế độ xem trước song song với soạn thảo
Nhấp vào 🕂 hoặc nhấn F11 để  bật/tắt chế độ toàn màn hình
Để highlight các đoạn code, hãy viết thêm tên viết thường của ngôn ngữ sau ba dấu gạch ngược (ví dụ: ```ruby)"></textarea>
      </div>
      <div class="col-md-4">
        <label for="category_id" class="form-label">Category</label>
        <select id="category_id" name="category_id" class="form-select" wire:model.debounce.500ms="post.category_id">
          <option selected>Choose...</option>
          @foreach($categories as $category)
            <option value="{{ $category->id }}"> {{ $category->name }}</option>
          @endforeach
        </select>
        @error('post.category_id') <span class="text-danger fs-6 fw-light"> {{ $message }} </span> @enderror
      </div>
      <div class="col-md-8">
        <label for="inputCity" class="form-label">Image</label>
        <input type="file" class="form-control input-sm" placeholder="image" wire:model.lazy="image">
        @error('image') <span class="text-danger fs-6 fw-light"> {{ $message }} </span> @enderror
      </div>
      <div class="col-12">
        <label for="inputCity" class="form-label">Preview</label>
        @if (!$this->image)
          <img src="{{ asset('images/no-image.png') }}" alt="" width="150">
        @else
          @if(is_string($image))
            <img src="{{ asset($post->image) }}" alt="" width="150">
          @else
            <img src="{{ $image->temporaryUrl() }}" alt="" width="150">
          @endif
        @endif
      </div>
      <div class="col-12">
        <label for="tags" class="form-label">Tags</label>
        <livewire:component.select class="w-100" :isMulti="true" :optChooses="$ids" :objects="$tags" />
      </div>
      <div class="col-12 row">
        <div class="col-6">
          <label for="prev" class="form-label">Bài viết trước</label>
          <select class="form-control" name="prev" id="prev" wire:model.debounce.500ms="post.prev_id">
            <option selected>Vui lòng chọn {{ $this->post->category_id ? '' : 'danh mục'}}</option>
            @foreach($postRelation as $postR)
              <option value="{{ $postR->id }}">{{ $postR->name }}</option>
            @endforeach
          </select>
          @error('post.prev_id') <span class="text-danger fs-6 fw-light"> {{ $message }} </span> @enderror
        </div>
        <div class="col-6">
          <label for="next" class="form-label">Bài viết kế tiếp</label>
          <select class="form-control" name="next" id="next" wire:model.debounce.500ms="post.next_id">
            <option selected>Vui lòng chọn {{ $this->post->category_id ? '' : 'danh mục'}}</option>
            @foreach($postRelation as $postR)
              <option value="{{ $postR->id }}">{{ $postR->name }}</option>
            @endforeach
          </select>
          @error('post.next_id') <span class="text-danger fs-6 fw-light"> {{ $message }} </span> @enderror
        </div>
      </div>
      <div class="col-12">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="published" name="published" value="{{!!$post->published}}" wire:model.debounce.500ms="post.published">
          <label class="form-check-label" for="published">
            Published ?
          </label>
          @error('post.published') <span class="text-danger fs-6 fw-light"> {{ $message }} </span> @enderror
        </div>
      </div>
      <div class="col-12">
        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">{{ $post->id ? 'Cập nhật' : 'Tạo mới' }}</button>
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
        singleLineBreaks: false,
        codeSyntaxHighlighting: true,
      },
      shortcuts: {
        drawTable: "Cmd-Alt-T"
      },
      showIcons: ["code", "table"],
      spellChecker: false,
      status: false,
      styleSelectedText: false,
      tabSize: 4,
      toolbarTips: false,
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

    Livewire.on('uploaded', pathImage => {
      let pos = simplemde.codemirror.getCursor();
      simplemde.codemirror.setSelection(pos, pos);
      simplemde.codemirror.replaceSelection(`![](${pathImage})`);
      doneTyping();
    })
  });
</script>
@stop
