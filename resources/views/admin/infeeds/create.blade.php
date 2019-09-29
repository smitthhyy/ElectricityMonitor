@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.infeed.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.infeeds.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
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
            <div class="form-group {{ $errors->has('phase_1') ? 'has-error' : '' }}">
                <label for="phase_1">{{ trans('cruds.infeed.fields.phase_1') }}*</label>
                <input type="number" id="phase_1" name="phase_1" class="form-control" value="{{ old('phase_1', isset($infeed) ? $infeed->phase_1 : '') }}" step="1" required>
                @if($errors->has('phase_1'))
                    <p class="help-block">
                        {{ $errors->first('phase_1') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.infeed.fields.phase_1_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('phase_2') ? 'has-error' : '' }}">
                <label for="phase_2">{{ trans('cruds.infeed.fields.phase_2') }}</label>
                <input type="number" id="phase_2" name="phase_2" class="form-control" value="{{ old('phase_2', isset($infeed) ? $infeed->phase_2 : '') }}" step="1">
                @if($errors->has('phase_2'))
                    <p class="help-block">
                        {{ $errors->first('phase_2') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.infeed.fields.phase_2_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('phase_3') ? 'has-error' : '' }}">
                <label for="phase_3">{{ trans('cruds.infeed.fields.phase_3') }}</label>
                <input type="number" id="phase_3" name="phase_3" class="form-control" value="{{ old('phase_3', isset($infeed) ? $infeed->phase_3 : '') }}" step="1">
                @if($errors->has('phase_3'))
                    <p class="help-block">
                        {{ $errors->first('phase_3') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.infeed.fields.phase_3_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('total') ? 'has-error' : '' }}">
                <label for="total">{{ trans('cruds.infeed.fields.total') }}*</label>
                <input type="number" id="total" name="total" class="form-control" value="{{ old('total', isset($infeed) ? $infeed->total : '') }}" step="1" required>
                @if($errors->has('total'))
                    <p class="help-block">
                        {{ $errors->first('total') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.infeed.fields.total_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection