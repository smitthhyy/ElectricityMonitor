@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.tplink.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.tplinks.update", [$tplink->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('mac') ? 'has-error' : '' }}">
                <label for="mac">{{ trans('cruds.tplink.fields.mac') }}*</label>
                <input type="text" id="mac" name="mac" class="form-control" value="{{ old('mac', isset($tplink) ? $tplink->mac : '') }}" required>
                @if($errors->has('mac'))
                    <p class="help-block">
                        {{ $errors->first('mac') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.tplink.fields.mac_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('timestamp') ? 'has-error' : '' }}">
                <label for="timestamp">{{ trans('cruds.tplink.fields.timestamp') }}*</label>
                <input type="number" id="timestamp" name="timestamp" class="form-control" value="{{ old('timestamp', isset($tplink) ? $tplink->timestamp : '') }}" step="1" required>
                @if($errors->has('timestamp'))
                    <p class="help-block">
                        {{ $errors->first('timestamp') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.tplink.fields.timestamp_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('voltage_mv') ? 'has-error' : '' }}">
                <label for="voltage_mv">{{ trans('cruds.tplink.fields.voltage_mv') }}</label>
                <input type="number" id="voltage_mv" name="voltage_mv" class="form-control" value="{{ old('voltage_mv', isset($tplink) ? $tplink->voltage_mv : '') }}" step="1">
                @if($errors->has('voltage_mv'))
                    <p class="help-block">
                        {{ $errors->first('voltage_mv') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.tplink.fields.voltage_mv_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('current_ma') ? 'has-error' : '' }}">
                <label for="current_ma">{{ trans('cruds.tplink.fields.current_ma') }}</label>
                <input type="number" id="current_ma" name="current_ma" class="form-control" value="{{ old('current_ma', isset($tplink) ? $tplink->current_ma : '') }}" step="1">
                @if($errors->has('current_ma'))
                    <p class="help-block">
                        {{ $errors->first('current_ma') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.tplink.fields.current_ma_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('power_mw') ? 'has-error' : '' }}">
                <label for="power_mw">{{ trans('cruds.tplink.fields.power_mw') }}</label>
                <input type="number" id="power_mw" name="power_mw" class="form-control" value="{{ old('power_mw', isset($tplink) ? $tplink->power_mw : '') }}" step="1">
                @if($errors->has('power_mw'))
                    <p class="help-block">
                        {{ $errors->first('power_mw') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.tplink.fields.power_mw_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('total_wh') ? 'has-error' : '' }}">
                <label for="total_wh">{{ trans('cruds.tplink.fields.total_wh') }}</label>
                <input type="number" id="total_wh" name="total_wh" class="form-control" value="{{ old('total_wh', isset($tplink) ? $tplink->total_wh : '') }}" step="1">
                @if($errors->has('total_wh'))
                    <p class="help-block">
                        {{ $errors->first('total_wh') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.tplink.fields.total_wh_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection