@extends('layouts.admin')
@section('content')
@can('config_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.configs.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.config.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.config.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Config">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.config.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.config.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.config.fields.value') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($configs as $key => $config)
                        <tr data-entry-id="{{ $config->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $config->id ?? '' }}
                            </td>
                            <td>
                                {{ $config->name ?? '' }}
                            </td>
                            <td>
                                {{ $config->value ?? '' }}
                            </td>
                            <td>
                                @can('config_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.configs.show', $config->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('config_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.configs.edit', $config->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('config_delete')
                                    <form action="{{ route('admin.configs.destroy', $config->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('config_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.configs.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-Config:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection