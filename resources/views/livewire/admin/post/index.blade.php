<div class="container-fluid px-4">
  <h1 class="mt-4">Post</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="index.html">Post</a></li>
    <li class="breadcrumb-item active">List</li>
  </ol>
  <div class="card mb-4">
    <div class="p-2 card-body d-flex">
      <div class="row col-8 d-flex">
        <a class="col-3 btn me-2 btn-info btn-sm text-white">
          <i class="bi bi-file-earmark-arrow-up-fill"></i> Import
        </a>
        <a class="col-3 btn me-2 btn-info btn-sm text-white">
          <i class="bi bi-file-earmark-arrow-down-fill"></i> Export
        </a>
      </div>
      <div class="col-4 d-flex justify-content-end">
        <a a class="btn btn-primary btn-sm text-white" href="{{ route('post.create') }}"> <i class="bi bi-plus"></i> Create </a>
      </div>
    </div>
  </div>
  <div class="card mb-4">
    <div class="card-body">
      <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
        <div class="dataTable-top">
          <div class="dataTable-dropdown">
            <label>
              Show
              <select class="dataTable-selector" wire:change="setPerPage($event.target.value)">
                <option value="5">5</option>
                <option value="10" selected="">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="25">25</option>
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
                  <a href="#" class="dataTable-sorter">ID</a>
                </th>
                <th>
                  <a href="#" class="dataTable-sorter">Image</a>
                </th>
                <th>
                  <a href="#" class="dataTable-sorter">Name</a>
                </th>
                <th>
                  <a href="#" class="dataTable-sorter">Description</a>
                </th>
                <th>
                  <a href="#" class="dataTable-sorter">Category</a>
                </th>
                <th>
                  <a href="#" class="dataTable-sorter">Views</a>
                </th>
                <th>
                  <a href="#" class="dataTable-sorter">Published</a>
                </th>
                <th>
                  <a href="#" class="dataTable-sorter">Published at</a>
                </th>
                <th>
                  <a href="#" class="dataTable-sorter">{{ (__("fields.actions")) }}</a>
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach($posts as $post)
              <tr :wire:key="{{ $post->id }}">
                <td style="vertical-align: middle;">
                  {{ $post->id }}
                </td>
                <td style="vertical-align: middle;text-align: center">
                  <img src="{{ $post->image_show }}" alt="" height="100" width="100">
                </td>
                <td style="vertical-align: middle">
                  {{ $post->name }}
                </td>
                <td class="max-text" style="vertical-align: middle">
                  {{ $post->description }}
                </td>
                <td class="max-text" style="vertical-align: middle">
                  {{ $post->category->name }}
                </td>
                <td class="max-text" style="vertical-align: middle">
                  {{ $post->views }}
                </td>
                <td style="vertical-align: middle; text-align: center">
                  @if($post->published)
                    <span class="badge bg-success">Published</span>
                  @else
                    <span class="badge bg-warning">No Published</span>
                  @endif
                </td>
                <td style="vertical-align: middle">
                  {{ $post->published_at }}
                </td>
                <td style="vertical-align: middle">
                  <a class="btn btn-sm btn-warning" href="{{ route('post.edit', $post->id) }}" :wire:key="$post->id">
                    <i class="bi bi-pencil-fill"></i>
                  </a>
                  <a class="btn btn-sm btn-info" href="{{ route('post.detail', $post->slug) }}" :wire:key="$post->id">
                    <i class="bi bi-eye"></i>
                  </a>
                  <button class="btn btn-sm btn-danger" wire:click="deleteId({{ $post->id }} )" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="bi bi-trash-fill"></i>
                  </button>
                  <a class="btn btn-sm btn-primary text-white" href="{{ route('post.create', ['clone_id' => $post->id]) }}" :wire:key="$post->id" title="Copy thể loại">
                    <i class="bi bi-clipboard-plus"></i>
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="dataTable-bottom">
          {{ $posts->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
