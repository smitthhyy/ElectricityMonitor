@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.infeed.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.infeed.fields.id') }}
                        </th>
                        <td>
                            {{ $infeed->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.infeed.fields.timestamp') }}
                        </th>
                        <td>
                            {{ $infeed->timestamp }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.infeed.fields.ch_1') }}
                        </th>
                        <td>
                            {{ $infeed->ch_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.infeed.fields.ch_2') }}
                        </th>
                        <td>
                            {{ $infeed->ch_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.infeed.fields.ch_3') }}
                        </th>
                        <td>
                            {{ $infeed->ch_3 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.infeed.fields.sensor') }}
                        </th>
                        <td>
                            {{ $infeed->sensor }}
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