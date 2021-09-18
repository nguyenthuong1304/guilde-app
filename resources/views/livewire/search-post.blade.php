<div class="row">
  <div class="col-lg-9 col-md-12">
    <div class="d-flex align-items-center p-3 my-3 text-white bg-purple rounded shadow-sm">
      <div class="col-8">
        <input type="text" class="form-control w-100" placeholder="Tìm kiếm gì đó ...." wire:model.debounce.800ms="term">
      </div>
      <div class="col-4">
        <input type="text" class="form-control w-100" placeholder="Tìm kiếm tag name ..." wire:model.debounce.800ms="tag">
      </div>
    </div>
    <div class="my-3 p-3 bg-body rounded shadow-sm">
      <div class="border-bottom d-flex justify-content-between pb-2">
        <span class="mb-0" style="line-height: 2;">Từ khoá : {{ $term }}</span>
        <div class="dropdown">
          <button class="btn btn-sm btn-secondary" type="button" id="dropdownSort">
            Sắp xếp theo : <span> {{ $orderBy == 'created_at' ? 'ngày đăng' : 'lượt xem'}}</span>
          </button>
          <ul class="dropdown-menu" id="ul-dropdownSort">
            <li><a class="dropdown-item" href="javascript:void(0)" wire:click="updateOrderBy('created_at')">Ngày đăng</a></li>
            <li><a class="dropdown-item" href="javascript:void(0)" wire:click="updateOrderBy('views')">Lượt xem</a></li>
          </ul>
        </div>
      </div>
      <div>
        <div wire:loading>
          @include('vendor.loader')
        </div>
        @foreach($posts as $post)
        <div class="d-flex text-muted pt-3">
          <img class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="35" height="35" src="{{ $post->image_show }}" alt="">
          <p class="pb-3 mb-0 small lh-sm border-bottom w-100">
            <a class="text-decoration-none" href="{{ route('detail', $post->slug) }}">
              <strong class="d-block text-gray-dark"> {{ $post->name }}</strong>
            </a>
            <span class="text-desc">{{ $post->description }}</span>
          </p>
        </div>
        @endforeach
      </div>
    </div>
    {{ $posts->links() }}
  </div>
  <div class="col-3 col-md-12"></div>
</div>
<style>
  .text-desc {
    max-height: 50px;
    display: block;
    overflow: hidden;
    font-size: 14px;
  }

  .shows {
    display: block !important;
  }

  #ul-dropdownSort a {
    width: 100%;
  }
</style>
@push('scripts')
<script>
  $(document).ready(function() {
    $('#dropdownSort').click(function(e) {
      e.preventDefault();
      $('#ul-dropdownSort').toggleClass('shows');
    })
  });
</script>
@endpush
