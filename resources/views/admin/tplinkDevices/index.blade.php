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
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-TplinkDevice">
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
                <tbody>
                    @foreach($tplinkDevices as $key => $tplinkDevice)
                        <tr data-entry-id="{{ $tplinkDevice->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $tplinkDevice->id ?? '' }}
                            </td>
                            <td>
                                {{ $tplinkDevice->mac ?? '' }}
                            </td>
                            <td>
                                {{ $tplinkDevice->alias ?? '' }}
                            </td>
                            <td>
                                {{ $tplinkDevice->ip ?? '' }}
                            </td>
                            <td>
                                {{ $tplinkDevice->port ?? '' }}
                            </td>
                            <td>
                                {{ App\TplinkDevice::ONLINE_RADIO[$tplinkDevice->online] ?? '' }}
                            </td>
                            <td>
                                {{ $tplinkDevice->updated_by->email ?? '' }}
                            </td>
                            <td>
                                {{ $tplinkDevice->updated_by->first_name ?? '' }}
                            </td>
                            <td>
                                {{ $tplinkDevice->updated_by->last_name ?? '' }}
                            </td>
                            <td>
                                @can('tplink_device_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.tplink-devices.show', $tplinkDevice->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('tplink_device_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.tplink-devices.edit', $tplinkDevice->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('tplink_device_delete')
                                    <form action="{{ route('admin.tplink-devices.destroy', $tplinkDevice->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('tplink_device_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.tplink-devices.massDestroy') }}",
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
  $('.datatable-TplinkDevice:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection