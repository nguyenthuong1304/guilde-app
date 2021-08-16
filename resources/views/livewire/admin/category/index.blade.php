<div class="container-fluid px-4">
  <h1 class="mt-4">Danh mục</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="index.html">Category</a></li>
    <li class="breadcrumb-item active">List</li>
  </ol>
  <div class="card mb-4">
    <div class="p-2 card-body d-flex flex-row-reverse">
      <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-create"> <i class="bi bi-plus"></i> Create </button>
    </div>
  </div>
  <div class="card mb-4">
    <div class="card-body">
      <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
        <div class="dataTable-top">
          <div class="dataTable-dropdown">
            <select class="dataTable-selector" wire:change="setPerPage($event.target.value)">
              <option value="5">5</option>
              <option value="10" selected="">10</option>
              <option value="15">15</option>
              <option value="20">20</option>
              <option value="25">25</option>
            </select>
          </div>
          <div class="dataTable-search">
            <input class="form-control" placeholder="Search..." type="text" wire:model.debounce.500ms="search">
          </div>
        </div>
        <div class="dataTable-container">
          <table id="datatablesSimple" class="dataTable-table table-responsive justify-content-center">
            <thead>
            <tr>
              @foreach($fields as $field)
                <th data-sortable="" style="width: 19.083%;">
                  <a href="?sort_by={{ $field }}" class="dataTable-sorter">{{ (__("fields.$field")) }}</a>
                </th>
              @endforeach
              <th data-sortable="" style="width: 19.083%;">
                <a href="#" class="dataTable-sorter">{{ (__("fields.actions")) }}</a>
              </th>
            </tr>
            </thead>
            <tbody>
            @foreach($objects as $object)
              <tr :wire:key="{{ $object->id }}">
                @foreach($fields as $field)
                  <td style="vertical-align: middle">
                    @if($field == 'image')
                      <img src="{{ $object->$field }}" alt="" height="100" width="100">
                    @else
                      {{ $object->$field }}
                    @endif
                  </td>
                @endforeach
                <td style="vertical-align: middle">
                  <button class="btn btn-sm btn-warning" wire:click="edit({{ $object->id }} )" data-bs-toggle="modal" data-bs-target="#modal-create">
                    <i class="bi bi-pencil-fill"></i>
                  </button>
                  <button class="btn btn-sm btn-danger" wire:click="deleteId({{ $object->id }} )" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="bi bi-trash-fill"></i>
                  </button>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        <div class="dataTable-bottom">
          {{ $objects->links() }}
        </div>
      </div>
    </div>
  </div>
  <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Confirm</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Are you sure want to delete?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Close</button>
          <button type="button" wire:click.prevent="delete()" class="btn btn-danger close-modal" data-bs-dismiss="modal">Yes, Delete</button>
        </div>
      </div>
    </div>
  </div>
  <div wire:ignore.self class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="modal-create" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal-create">Create category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div>
            <form>
              @csrf
              <input type="hidden" value="{{ $idCate }}" wire:model="idCate">
              <div class="form-group">
                <label for="exampleInputPassword1">Enter Name</label>
                <input type="text" wire:model.lazy="name" class="form-control input-sm" placeholder="Name">
                @error('name') <span class="text-danger fs-6 fw-light"> {{ $message }} </span> @enderror
              </div>
              <div class="form-group">
                <label>Enter description</label>
                <textarea rows="10" cols="20" class="form-control input-sm" placeholder="Enter description" wire:model.lazy="description"></textarea>
                @error('description') <span class="text-danger fs-6 fw-light"> {{ $message }} </span> @enderror
              </div>
              <div class="form-group">
                <label>Image</label>
                <input type="file" class="form-control input-sm" placeholder="image" wire:model.lazy="image"></input>
                @error('image') <span class="text-danger fs-6 fw-light"> {{ $message }} </span> @enderror
              </div>
              <div class="form-group">
                <label>Parent category</label>
                <select class="form-control" name="parent_id" id="parent_id" wire:model.lazy="parent_id">
                  <option value="" selected>Please Choose...</option>
                  @foreach($parents as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @endForeach
                </select>
                @error('parent_id') <span class="text-danger fs-6 fw-light"> {{ $message }} </span> @enderror
              </div>
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success close-modal" data-bs-dismiss="modal" wire:click.prevent="save()">Submit</button>
        </div>
      </div>
    </div>
  </div>
</div>
@push('scripts')
<script>
$(document).ready(function () {
  $('#modal-create').on('hidden.bs.modal', function () {
    Livewire.emit('resetInput')
  });
});
</script>
@endpush
