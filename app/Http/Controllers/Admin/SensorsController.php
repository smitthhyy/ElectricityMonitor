<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySensorRequest;
use App\Http\Requests\StoreSensorRequest;
use App\Http\Requests\UpdateSensorRequest;
use App\Sensor;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SensorsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('sensor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sensors = Sensor::all();

        return view('admin.sensors.index', compact('sensors'));
    }

    public function create()
    {
        abort_if(Gate::denies('sensor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sensors.create');
    }

    public function store(StoreSensorRequest $request)
    {
        $sensor = Sensor::create($request->all());

        return redirect()->route('admin.sensors.index');
    }

    public function edit(Sensor $sensor)
    {
        abort_if(Gate::denies('sensor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sensors.edit', compact('sensor'));
    }

    public function update(UpdateSensorRequest $request, Sensor $sensor)
    {
        $sensor->update($request->all());

        return redirect()->route('admin.sensors.index');
    }

    public function show(Sensor $sensor)
    {
        abort_if(Gate::denies('sensor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sensors.show', compact('sensor'));
    }

    public function destroy(Sensor $sensor)
    {
        abort_if(Gate::denies('sensor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sensor->delete();

        return back();
    }

    public function massDestroy(MassDestroySensorRequest $request)
    {
        Sensor::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
