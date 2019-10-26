@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.infeed.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.infeeds.update", [$infeed->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('timestamp') ? 'has-error' : '' }}">
                <label for="timestamp">{{ trans('cruds.infeed.fields.timestamp') }}*</label>
                <input type="number" id="timestamp" name="timestamp" class="form-control" value="{{ old('timestamp', isset($infeed) ? $infeed->timestamp : '') }}" step="1" required>
                @if($errors->has('timestamp'))
                    <p class="help-block">
                        {{ $errors->first('timestamp') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.infeed.fields.timestamp_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('ch_1') ? 'has-error' : '' }}">
                <label for="ch_1">{{ trans('cruds.infeed.fields.ch_1') }}</label>
                <input type="number" id="ch_1" name="ch_1" class="form-control" value="{{ old('ch_1', isset($infeed) ? $infeed->ch_1 : '') }}" step="1">
                @if($errors->has('ch_1'))
                    <p class="help-block">
                        {{ $errors->first('ch_1') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.infeed.fields.ch_1_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('ch_2') ? 'has-error' : '' }}">
                <label for="ch_2">{{ trans('cruds.infeed.fields.ch_2') }}</label>
                <input type="number" id="ch_2" name="ch_2" class="form-control" value="{{ old('ch_2', isset($infeed) ? $infeed->ch_2 : '') }}" step="1">
                @if($errors->has('ch_2'))
                    <p class="help-block">
                        {{ $errors->first('ch_2') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.infeed.fields.ch_2_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('ch_3') ? 'has-error' : '' }}">
                <label for="ch_3">{{ trans('cruds.infeed.fields.ch_3') }}</label>
                <input type="number" id="ch_3" name="ch_3" class="form-control" value="{{ old('ch_3', isset($infeed) ? $infeed->ch_3 : '') }}" step="1">
                @if($errors->has('ch_3'))
                    <p class="help-block">
                        {{ $errors->first('ch_3') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.infeed.fields.ch_3_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('sensor') ? 'has-error' : '' }}">
                <label for="sensor">{{ trans('cruds.infeed.fields.sensor') }}*</label>
                <input type="number" id="sensor" name="sensor" class="form-control" value="{{ old('sensor', isset($infeed) ? $infeed->sensor : '') }}" step="1" required>
                @if($errors->has('sensor'))
                    <p class="help-block">
                        {{ $errors->first('sensor') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.infeed.fields.sensor_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection