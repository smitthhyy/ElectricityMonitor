@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.tplink.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.tplink.fields.id') }}
                        </th>
                        <td>
                            {{ $tplink->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tplink.fields.mac') }}
                        </th>
                        <td>
                            {{ $tplink->mac }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tplink.fields.timestamp') }}
                        </th>
                        <td>
                            {{ $tplink->timestamp }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tplink.fields.voltage_mv') }}
                        </th>
                        <td>
                            {{ $tplink->voltage_mv }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tplink.fields.current_ma') }}
                        </th>
                        <td>
                            {{ $tplink->current_ma }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tplink.fields.power_mw') }}
                        </th>
                        <td>
                            {{ $tplink->power_mw }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tplink.fields.total_wh') }}
                        </th>
                        <td>
                            {{ $tplink->total_wh }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tplink.fields.updated_by') }}
                        </th>
                        <td>
                            {{ $tplink->updated_by->email ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>


    </div>
</div>
@endsection