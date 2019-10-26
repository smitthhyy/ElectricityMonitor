@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.sensor.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.sensors.update", [$sensor->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.sensor.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($sensor) ? $sensor->name : '') }}" required>
                @if($errors->has('name'))
                    <p class="help-block">
                        {{ $errors->first('name') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.sensor.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('id_field') ? 'has-error' : '' }}">
                <label for="id_field">{{ trans('cruds.sensor.fields.id_field') }}*</label>
                <input type="number" id="id_field" name="id_field" class="form-control" value="{{ old('id_field', isset($sensor) ? $sensor->id_field : '') }}" step="1" required>
                @if($errors->has('id_field'))
                    <p class="help-block">
                        {{ $errors->first('id_field') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.sensor.fields.id_field_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection