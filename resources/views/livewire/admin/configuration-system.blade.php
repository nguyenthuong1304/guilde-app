@section('styles')
<style>
  .w-80 {
    width: 80% !important;
  }
</style>
@stop
<div class="container-fluid px-4">
  <h1 class="mt-4">Cài đặt</h1>
  <div class="card mb-4">
    <div class="card-body">
      <form class="row g-3">
        <div class="col-md-6">
          <label for="title" class="form-label">Tiêu đề</label>
          <input name="title" type="text" class="form-control @error('configuration.title')is-invalid @enderror" placeholder="Tiêu đề" id="title" wire:model.debounce.500ms="configuration.title">
          @error('configuration.title')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="col-md-6">
          <label for="total_post_a_cate" class="form-label">Số bài viết hiển thị</label>
          <input type="number" class="form-control @error('configuration.total_post_a_cate')is-invalid @enderror" placeholder="Số bài viết hiển thị trên một danh mục" id="total_post_a_cate" wire:model.debounce.500ms="configuration.total_post_a_cate">
          @error('configuration.email')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="col-md-6">
          <label for="text" class="form-label">Facebook URL</label>
          <input type="text" class="form-control @error('configuration.facebook_link')is-invalid @enderror" placeholder="Facebook URL" id="facebook_link" wire:model.debounce.500ms="configuration.facebook_link">
          @error('configuration.facebook_link')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="col-md-6">
          <label for="instagram_link" class="form-label">Instagram URL</label>
          <input class="form-control @error('configuration.instagram_link')is-invalid @enderror" placeholder="Instagram URL" id="instagram_link" wire:model.debounce.500ms="configuration.instagram_link">
          @error('configuration.country')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="col-6">
          <label for="instagram_link" class="form-label">Twitter URL</label>
          <input class="form-control @error('configuration.twitter_link')is-invalid @enderror" placeholder="Twitter URL" id="twitter_link" wire:model.debounce.500ms="configuration.twitter_link">
          @error('configuration.twitter_link')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="col-md-6">
          <label for="inputCity" class="form-label">URL cá nhân</label>
          <input type="text" class="form-control @error('configuration.personal_link')is-invalid @enderror" placeholder="URL cá nhân" wire:model.debounce.500ms="configuration.personal_link">
          @error('configuration.personal_link') <span class="text-danger fs-6 fw-light"> {{ $message }} </span> @enderror
        </div>
        <div class="col-md-6">
          <label for="inputCity" class="form-label">Mật khẩu</label>
          <input type="password" class="form-control @error('password')is-invalid @enderror" placeholder="Mật khẩu" wire:model.debounce.500ms="password">
          @error('password') <span class="text-danger fs-6 fw-light"> {{ $message }} </span> @enderror
        </div>
        <div class="col-md-6">
          <label for="inputCity" class="form-label">Nhập lại mật khẩu</label>
          <input type="password" class="form-control @error('password_confirmation')is-invalid @enderror" placeholder="Nhập lại mật khẩu" wire:model.debounce.500ms="password_confirmation">
          @error('password_confirmation') <span class="text-danger fs-6 fw-light"> {{ $message }} </span> @enderror
        </div>
        <div class="col-md-6">
          <label for="banner" class="form-label">Banner</label>
          <input type="file" class="form-control @error('configuration.personal_link')is-invalid @enderror" wire:model.debounce.500ms="configuration.banner">
          @error('configuration.banner') <span class="text-danger fs-6 fw-light"> {{ $message }} </span> @enderror
        </div>
        <div class="col-md-6">
          <label for="favicon" class="form-label">Banner</label>
          <input type="file" class="form-control @error('configuration.personal_link')is-invalid @enderror" wire:model.debounce.500ms="configuration.favicon">
          @error('configuration.favicon') <span class="text-danger fs-6 fw-light"> {{ $message }} </span> @enderror
        </div>
        <div class="col-12 text-center mt-5">
          @if (!$banner)
            <img src="{{ asset('images/no-image.png') }}" alt="" width="150">
          @else
            @if(is_string($banner))
              <img src="{{ $banner }}" alt="" class="w-80">
            @else
              <img src="{{ $banner->temporaryUrl() }}" alt="" width="150">
            @endif
          @endif
        </div>
        <div class="col-12">
          <button class="btn btn-primary" type="submit" wire:click.prevent="store">Cập nhật</button>
        </div>
      </form>
    </div>
  </div>
</div>
