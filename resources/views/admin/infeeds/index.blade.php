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
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Infeed">
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
                        {{ trans('cruds.infeed.fields.ch_1') }}
                    </th>
                    <th>
                        {{ trans('cruds.infeed.fields.ch_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.infeed.fields.ch_3') }}
                    </th>
                    <th>
                        {{ trans('cruds.infeed.fields.sensor') }}
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
@can('infeed_delete')
        let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.infeeds.massDestroy') }}",
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
                        data: { ids: ids, _method: 'DELETE' }
                    }).done(function () { location.reload() })
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
            ajax: "{{ route('admin.infeeds.index') }}",
            columns: [
                { data: 'placeholder', name: 'placeholder' },
                { data: 'id', name: 'id' },
                { data: 'timestamp', name: 'timestamp' },
                { data: 'ch_1', name: 'ch_1' },
                { data: 'ch_2', name: 'ch_2' },
                { data: 'ch_3', name: 'ch_3' },
                { data: 'sensor', name: 'sensor' },
                { data: 'actions', name: '{{ trans('global.actions') }}' }
            ],
            order: [[ 1, 'desc' ]],
            pageLength: 100,
        };
        $('.datatable-Infeed').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
    });

</script>
@endsection
