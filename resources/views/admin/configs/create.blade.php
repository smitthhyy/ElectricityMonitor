@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.config.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.configs.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.config.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($config) ? $config->name : '') }}" required>
                @if($errors->has('name'))
                    <p class="help-block">
                        {{ $errors->first('name') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.config.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('value') ? 'has-error' : '' }}">
                <label for="value">{{ trans('cruds.config.fields.value') }}</label>
                <input type="text" id="value" name="value" class="form-control" value="{{ old('value', isset($config) ? $config->value : '') }}">
                @if($errors->has('value'))
                    <p class="help-block">
                        {{ $errors->first('value') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.config.fields.value_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection