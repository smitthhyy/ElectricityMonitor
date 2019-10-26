@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.channel.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.channels.update", [$channel->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('sensor_id') ? 'has-error' : '' }}">
                <label for="sensor">{{ trans('cruds.channel.fields.sensor') }}*</label>
                <select name="sensor_id" id="sensor" class="form-control select2" required>
                    @foreach($sensors as $id => $sensor)
                        <option value="{{ $id }}" {{ (isset($channel) && $channel->sensor ? $channel->sensor->id : old('sensor_id')) == $id ? 'selected' : '' }}>{{ $sensor }}</option>
                    @endforeach
                </select>
                @if($errors->has('sensor_id'))
                    <p class="help-block">
                        {{ $errors->first('sensor_id') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.channel.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($channel) ? $channel->name : '') }}" required>
                @if($errors->has('name'))
                    <p class="help-block">
                        {{ $errors->first('name') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.channel.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('channel') ? 'has-error' : '' }}">
                <label for="channel">{{ trans('cruds.channel.fields.channel') }}*</label>
                <input type="number" id="channel" name="channel" class="form-control" value="{{ old('channel', isset($channel) ? $channel->channel : '') }}" step="1" required>
                @if($errors->has('channel'))
                    <p class="help-block">
                        {{ $errors->first('channel') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.channel.fields.channel_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection