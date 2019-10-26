@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.tplinkDevice.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.tplink-devices.update", [$tplinkDevice->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('mac') ? 'has-error' : '' }}">
                <label for="mac">{{ trans('cruds.tplinkDevice.fields.mac') }}*</label>
                <input type="text" id="mac" name="mac" class="form-control" value="{{ old('mac', isset($tplinkDevice) ? $tplinkDevice->mac : '') }}" required>
                @if($errors->has('mac'))
                    <p class="help-block">
                        {{ $errors->first('mac') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.tplinkDevice.fields.mac_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('alias') ? 'has-error' : '' }}">
                <label for="alias">{{ trans('cruds.tplinkDevice.fields.alias') }}</label>
                <input type="text" id="alias" name="alias" class="form-control" value="{{ old('alias', isset($tplinkDevice) ? $tplinkDevice->alias : '') }}">
                @if($errors->has('alias'))
                    <p class="help-block">
                        {{ $errors->first('alias') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.tplinkDevice.fields.alias_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('ip') ? 'has-error' : '' }}">
                <label for="ip">{{ trans('cruds.tplinkDevice.fields.ip') }}</label>
                <input type="text" id="ip" name="ip" class="form-control" value="{{ old('ip', isset($tplinkDevice) ? $tplinkDevice->ip : '') }}">
                @if($errors->has('ip'))
                    <p class="help-block">
                        {{ $errors->first('ip') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.tplinkDevice.fields.ip_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('port') ? 'has-error' : '' }}">
                <label for="port">{{ trans('cruds.tplinkDevice.fields.port') }}</label>
                <input type="number" id="port" name="port" class="form-control" value="{{ old('port', isset($tplinkDevice) ? $tplinkDevice->port : '') }}" step="1">
                @if($errors->has('port'))
                    <p class="help-block">
                        {{ $errors->first('port') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.tplinkDevice.fields.port_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('online') ? 'has-error' : '' }}">
                <label>{{ trans('cruds.tplinkDevice.fields.online') }}</label>
                @foreach(App\TplinkDevice::ONLINE_RADIO as $key => $label)
                    <div>
                        <input id="online_{{ $key }}" name="online" type="radio" value="{{ $key }}" {{ old('online', $tplinkDevice->online) === (string)$key ? 'checked' : '' }}>
                        <label for="online_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('online'))
                    <p class="help-block">
                        {{ $errors->first('online') }}
                    </p>
                @endif
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection