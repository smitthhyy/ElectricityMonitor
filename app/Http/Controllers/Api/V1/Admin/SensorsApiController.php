<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSensorRequest;
use App\Http\Requests\UpdateSensorRequest;
use App\Http\Resources\Admin\SensorResource;
use App\Sensor;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SensorsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('sensor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SensorResource(Sensor::all());
    }

    public function store(StoreSensorRequest $request)
    {
        $sensor = Sensor::create($request->all());

        return (new SensorResource($sensor))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Sensor $sensor)
    {
        abort_if(Gate::denies('sensor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SensorResource($sensor);
    }

    public function update(UpdateSensorRequest $request, Sensor $sensor)
    {
        $sensor->update($request->all());

        return (new SensorResource($sensor))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Sensor $sensor)
    {
        abort_if(Gate::denies('sensor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sensor->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
