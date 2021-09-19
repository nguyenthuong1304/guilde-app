@section('styles')
<style>
.container-1 {
  position: relative;
}

.img-content {
  max-height: 200px;
}

.checkbox {
  position: absolute;
  right: 5px;
  top: 5px;
}
</style>
@stop
<div class="container-fluid px-4">
  <h1 class="mt-4">Post</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">
      <a href="{{ route('post_index') }}">Post</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{ route('post_index') }}">List</a>
    </li>
    <li class="breadcrumb-item active">Image content</li>
  </ol>
  <div class="card mb-4">
    <div class="card-body row row-cols-1 row-cols-md-5 g-4">
      @foreach($files as $file)
        <div class="col">
          <div class="card container-1">
            <img src="{{ $file['url'] }}" class="card-img-top w-100 img-content" loading="lazy">
            <input type="checkbox" class="checkbox" data-value="{{ $file['path'] }}"/>
          </div>
        </div>
      @endforeach
    </div>
  </div>
  <div class="row">
    {{ $files->links('vendor.livewire.bootstrap') }}
  </div>
</div>
@section('scripts')
<script>
  $(document).ready(function () {
    $('.img-content').click(function () {
      $(this).next().click();
    });

    $(document).keydown(function (e) {
      if (e.which === 8) {
        if (confirm('Chắc chắn')) {
          let list = $('.checkbox:checked').map((index, item) => $(item).data('value'));
          Livewire.emit('deleteImage', list.get());
        }
      }
    });
  });
</script>
@stop
