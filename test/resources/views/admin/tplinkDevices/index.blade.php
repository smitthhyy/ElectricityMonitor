@extends('layouts.admin')
@section('content')
@can('tplink_device_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.tplink-devices.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.tplinkDevice.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.tplinkDevice.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-TplinkDevice">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.tplinkDevice.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.tplinkDevice.fields.mac') }}
                    </th>
                    <th>
                        {{ trans('cruds.tplinkDevice.fields.alias') }}
                    </th>
                    <th>
                        {{ trans('cruds.tplinkDevice.fields.ip') }}
                    </th>
                    <th>
                        {{ trans('cruds.tplinkDevice.fields.port') }}
                    </th>
                    <th>
                        {{ trans('cruds.tplinkDevice.fields.online') }}
                    </th>
                    <th>
                        {{ trans('cruds.tplinkDevice.fields.updated_by') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.first_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.last_name') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('tplink_device_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.tplink-devices.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.tplink-devices.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'mac', name: 'mac' },
{ data: 'alias', name: 'alias' },
{ data: 'ip', name: 'ip' },
{ data: 'port', name: 'port' },
{ data: 'online', name: 'online' },
{ data: 'updated_by_email', name: 'updated_by.email' },
{ data: 'updated_by.first_name', name: 'updated_by.first_name' },
{ data: 'updated_by.last_name', name: 'updated_by.last_name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  $('.datatable-TplinkDevice').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

</script>
@endsection