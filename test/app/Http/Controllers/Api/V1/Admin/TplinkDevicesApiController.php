<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTplinkDeviceRequest;
use App\Http\Requests\UpdateTplinkDeviceRequest;
use App\Http\Resources\Admin\TplinkDeviceResource;
use App\TplinkDevice;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TplinkDevicesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tplink_device_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TplinkDeviceResource(TplinkDevice::with(['updated_by'])->get());
    }

    public function store(StoreTplinkDeviceRequest $request)
    {
        $tplinkDevice = TplinkDevice::create($request->all());

        return (new TplinkDeviceResource($tplinkDevice))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TplinkDevice $tplinkDevice)
    {
        abort_if(Gate::denies('tplink_device_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TplinkDeviceResource($tplinkDevice->load(['updated_by']));
    }

    public function update(UpdateTplinkDeviceRequest $request, TplinkDevice $tplinkDevice)
    {
        $tplinkDevice->update($request->all());

        return (new TplinkDeviceResource($tplinkDevice))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TplinkDevice $tplinkDevice)
    {
        abort_if(Gate::denies('tplink_device_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tplinkDevice->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
