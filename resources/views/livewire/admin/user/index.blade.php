<div class="container-fluid px-4">
  <h1 class="mt-4">User</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="index.html">User</a></li>
    <li class="breadcrumb-item active">List</li>
  </ol>
  <div class="card mb-4">
    <div class="card-body">
      <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
        <div class="dataTable-top">
          <div class="dataTable-dropdown">
            <label>
              Show
              <select class="dataTable-selector" wire:change="setPerPage($event.target.value)">
                <option value="10">10</option>
                <option value="20" selected="">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
              </select>
            </label>
            <label>
              - Sắp xếp theo:
              <select class="dataTable-selector" wire:model.debounce.500ms="orderBy">
                <option value="created_at">Ngày đăng</option>
                <option value="id">ID</option>
                <option value="views">Lượt xem</option>
                <option value="published_at">Ngày xuất bản</option>
                <option value="published">Trạng tháin</option>
              </select>
            <label>
              - Thứ tự:
              <select class="dataTable-selector" wire:model.debounce.500ms="order">
                <option value="desc">Giảm dần</option>
                <option value="asc">Tăng dần</option>
              </select>
          </label>
          </div>
          <div class="dataTable-search">
            <input class="form-control" placeholder="Search..." type="text" wire:model.debounce.500ms="search">
          </div>
        </div>
        <div class="dataTable-container" wire:loading.class="overlay">
          <table id="datatablesSimple" class="dataTable-table table-responsive justify-content-center">
            <thead>
              <tr>
                <th>
                  <a href="#" class="dataTable-sorter">Email</a>
                </th>
                <th>
                  <a href="#" class="dataTable-sorter">Tên</a>
                </th>
                <th>
                  <a href="#" class="dataTable-sorter">Avatar</a>
                </th>
                <th>
                  <a href="#" class="dataTable-sorter">Provider</a>
                </th>
                <th>
                  <a href="#" class="dataTable-sorter">{{ (__("fields.actions")) }}</a>
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
              <tr :wire:key="{{ $user->id }}">
                <td style="vertical-align: middle">
                  {{ $user->email }}
                </td>
                <td style="vertical-align: middle">
                  {{ $user->name }}
                </td>
                <td style="vertical-align: middle;text-align: center">
                  <img src="{{ $user->avatar }}" alt="" height="100" width="100">
                </td>
                <td class="max-text" style="vertical-align: middle">
                  {{ $user->provider_name ?? 'Web' }}
                </td>
                <td style="vertical-align: middle">
                  {{-- <a class="btn btn-sm btn-warning" href="{{ route('post.edit', $user->id) }}" :wire:key="$user->id">
                    <i class="bi bi-pencil-fill"></i>
                  </a>
                  <a class="btn btn-sm btn-info" href="{{ route('user.detail', $user->slug) }}" :wire:key="$user->id">
                    <i class="bi bi-eye"></i>
                  </a>
                  <button class="btn btn-sm btn-danger delete-user" data-id="{{ $user->id }}">
                    <i class="bi bi-trash-fill"></i>
                  </button> --}}
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="dataTable-bottom">
          {{ $users->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
@section('scripts')
<script>
  $(document).ready(function () {
    $('body').on('click', '.delete-post', function () {
      const id = $(this).attr('data-id');
      if (confirm('Bạn chắc chứ ?')) {
        Livewire.emit('deletePost', id)
      }
    });
    $('#check-all').click(function () {
      $('.input-view').click();
    });

    $('#add-view').click(function () {
      let inputs = $('.input-view:checked');
      if (!inputs.length) {
        toastr['warning']('Bạn chưa chọn bài viết nào!')
      } else {
        let views = prompt('Bạn muốn tăng bao nhiêu view');
        if (views > 0) {
          if (confirm('Bạn chắc chứ')) {
            const ids = inputs.map((item, index) => $(index).val()).get();
            Livewire.emit('addView', ids, views)
          }
        }
      }
    });
  });
</script>
@stop
