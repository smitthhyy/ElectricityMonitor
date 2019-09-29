@extends('layouts.admin')
@section('content')
@can('infeed_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.infeeds.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.infeed.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.infeed.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Infeed">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.infeed.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.infeed.fields.timestamp') }}
                        </th>
                        <th>
                            {{ trans('cruds.infeed.fields.phase_1') }}
                        </th>
                        <th>
                            {{ trans('cruds.infeed.fields.phase_2') }}
                        </th>
                        <th>
                            {{ trans('cruds.infeed.fields.phase_3') }}
                        </th>
                        <th>
                            {{ trans('cruds.infeed.fields.total') }}
                        </th>
                        <th>
                            {{ trans('cruds.infeed.fields.updated_by') }}
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
                    @foreach($infeeds as $key => $infeed)
                        <tr data-entry-id="{{ $infeed->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $infeed->id ?? '' }}
                            </td>
                            <td>
                                {{ $infeed->timestamp ?? '' }}
                            </td>
                            <td>
                                {{ $infeed->phase_1 ?? '' }}
                            </td>
                            <td>
                                {{ $infeed->phase_2 ?? '' }}
                            </td>
                            <td>
                                {{ $infeed->phase_3 ?? '' }}
                            </td>
                            <td>
                                {{ $infeed->total ?? '' }}
                            </td>
                            <td>
                                {{ $infeed->updated_by->email ?? '' }}
                            </td>
                            <td>
                                {{ $infeed->updated_by->first_name ?? '' }}
                            </td>
                            <td>
                                {{ $infeed->updated_by->last_name ?? '' }}
                            </td>
                            <td>
                                @can('infeed_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.infeeds.show', $infeed->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('infeed_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.infeeds.edit', $infeed->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('infeed_delete')
                                    <form action="{{ route('admin.infeeds.destroy', $infeed->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('infeed_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.infeeds.massDestroy') }}",
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
  $('.datatable-Infeed:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection