<div class="container-fluid px-4">
  <h1 class="mt-4">TIPs</h1>
  <div class="card mb-4">
    <div class="p-2 card-body d-flex">
      <div class="d-flex justify-content-end">
        <a a class="btn btn-primary btn-sm text-white" href="{{ route('tip.create') }}"> <i class="bi bi-plus"></i> Create </a>
      </div>
    </div>
  </div>
  <div class="card mb-4">
    <div class="card-body">
      <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
        <div class="dataTable-container" wire:loading.class="overlay">
          <table id="datatablesSimple" class="dataTable-table table-responsive justify-content-center">
            <thead>
            <tr>
              <th>
                <a href="#" class="dataTable-sorter">ID</a>
              </th>
              <th>
                <a href="#" class="dataTable-sorter">Tiêu đề</a>
              </th>
              <th>
                <a href="#" class="dataTable-sorter">Ngôn ngữ</a>
              </th>
              <th>
                <a href="#" class="dataTable-sorter">{{ (__("fields.actions")) }}</a>
              </th>
            </tr>
            </thead>
            <tbody>
            @foreach($tips as $tip)
              <tr :wire:key="{{ $tip->id }}">
                <td style="vertical-align: middle;">
                  {{ $tip->id }}
                </td>
                <td style="vertical-align: middle">
                  {{ $tip->title }}
                </td>
                <td class="max-text" style="vertical-align: middle">
                  {{ $tip->lang }}
                </td>
                <td style="vertical-align: middle">
                  <a class="btn btn-sm btn-warning" href="{{ route('tip.edit', $tip->id) }}" :wire:key="$tip->id">
                    <i class="bi bi-pencil-fill"></i>
                  </a>
                  <button class="btn btn-sm btn-danger delete-tip" data-id="{{ $tip->id }}">
                    <i class="bi bi-trash-fill"></i>
                  </button>
                  </a>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        <div class="dataTable-bottom">
          {{ $tips->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
