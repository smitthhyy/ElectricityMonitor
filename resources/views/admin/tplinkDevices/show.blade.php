@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.tplinkDevice.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.tplinkDevice.fields.id') }}
                        </th>
                        <td>
                            {{ $tplinkDevice->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tplinkDevice.fields.mac') }}
                        </th>
                        <td>
                            {{ $tplinkDevice->mac }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tplinkDevice.fields.alias') }}
                        </th>
                        <td>
                            {{ $tplinkDevice->alias }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tplinkDevice.fields.ip') }}
                        </th>
                        <td>
                            {{ $tplinkDevice->ip }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tplinkDevice.fields.port') }}
                        </th>
                        <td>
                            {{ $tplinkDevice->port }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tplinkDevice.fields.online') }}
                        </th>
                        <td>
                            {{ App\TplinkDevice::ONLINE_RADIO[$tplinkDevice->online] }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tplinkDevice.fields.updated_by') }}
                        </th>
                        <td>
                            {{ $tplinkDevice->updated_by->email ?? '' }}
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