<div>
  <div wire:ignore>
    <select class="form-control" id="select2-dropdown" @if($isMulti) multiple @endif>
      <option value="">Select Option</option>
        @foreach($objects as $item)
          <option value="{{ $item->$key }}">{{ $item->$value }}</option>
        @endforeach
    </select>
  </div>
</div>

@push('scripts')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.1.1/dist/select2-bootstrap-5-theme.rtl.min.css" />
  <script>
    $(document).ready(function () {
      $('#select2-dropdown').val('{{ implode(',', $optChooses) }}'.split(',')).trigger('change')
      $('#select2-dropdown').select2({
        theme: "bootstrap-5",
        closeOnSelect: false,
        @if($isMulti)
          tags: true,
          // createTag: function (params) {
          //   return {
          //     id: params.term,
          //     text: params.term,
          //     newOption: true
          //   }
          // },
        @endif
      });
      $('#select2-dropdown').on('change', function (e) {
        let data = $('#select2-dropdown').select2("val");
        @this.set('optChooses', data);
      });
    });
  </script>
@endpush
