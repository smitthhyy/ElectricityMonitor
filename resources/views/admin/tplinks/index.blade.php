@extends('layouts.admin')
@section('content')
@can('tplink_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.tplinks.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.tplink.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.tplink.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Tplink">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.tplink.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.tplink.fields.mac') }}
                        </th>
                        <th>
                            {{ trans('cruds.tplink.fields.timestamp') }}
                        </th>
                        <th>
                            {{ trans('cruds.tplink.fields.voltage_mv') }}
                        </th>
                        <th>
                            {{ trans('cruds.tplink.fields.current_ma') }}
                        </th>
                        <th>
                            {{ trans('cruds.tplink.fields.power_mw') }}
                        </th>
                        <th>
                            {{ trans('cruds.tplink.fields.total_wh') }}
                        </th>
                        <th>
                            {{ trans('cruds.tplink.fields.updated_by') }}
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
                    @foreach($tplinks as $key => $tplink)
                        <tr data-entry-id="{{ $tplink->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $tplink->id ?? '' }}
                            </td>
                            <td>
                                {{ $tplink->mac ?? '' }}
                            </td>
                            <td>
                                {{ $tplink->timestamp ?? '' }}
                            </td>
                            <td>
                                {{ $tplink->voltage_mv ?? '' }}
                            </td>
                            <td>
                                {{ $tplink->current_ma ?? '' }}
                            </td>
                            <td>
                                {{ $tplink->power_mw ?? '' }}
                            </td>
                            <td>
                                {{ $tplink->total_wh ?? '' }}
                            </td>
                            <td>
                                {{ $tplink->updated_by->email ?? '' }}
                            </td>
                            <td>
                                {{ $tplink->updated_by->first_name ?? '' }}
                            </td>
                            <td>
                                {{ $tplink->updated_by->last_name ?? '' }}
                            </td>
                            <td>
                                @can('tplink_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.tplinks.show', $tplink->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('tplink_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.tplinks.edit', $tplink->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('tplink_delete')
                                    <form action="{{ route('admin.tplinks.destroy', $tplink->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('tplink_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.tplinks.massDestroy') }}",
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
  $('.datatable-Tplink:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection