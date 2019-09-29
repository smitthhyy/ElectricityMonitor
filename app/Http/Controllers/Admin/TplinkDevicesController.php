<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTplinkDeviceRequest;
use App\Http\Requests\StoreTplinkDeviceRequest;
use App\Http\Requests\UpdateTplinkDeviceRequest;
use App\TplinkDevice;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TplinkDevicesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tplink_device_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tplinkDevices = TplinkDevice::all();

        return view('admin.tplinkDevices.index', compact('tplinkDevices'));
    }

    public function create()
    {
        abort_if(Gate::denies('tplink_device_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tplinkDevices.create');
    }

    public function store(StoreTplinkDeviceRequest $request)
    {
        $tplinkDevice = TplinkDevice::create($request->all());

        return redirect()->route('admin.tplink-devices.index');
    }

    public function edit(TplinkDevice $tplinkDevice)
    {
        abort_if(Gate::denies('tplink_device_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tplinkDevice->load('updated_by');

        return view('admin.tplinkDevices.edit', compact('tplinkDevice'));
    }

    public function update(UpdateTplinkDeviceRequest $request, TplinkDevice $tplinkDevice)
    {
        $tplinkDevice->update($request->all());

        return redirect()->route('admin.tplink-devices.index');
    }

    public function show(TplinkDevice $tplinkDevice)
    {
        abort_if(Gate::denies('tplink_device_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tplinkDevice->load('updated_by');

        return view('admin.tplinkDevices.show', compact('tplinkDevice'));
    }

    public function destroy(TplinkDevice $tplinkDevice)
    {
        abort_if(Gate::denies('tplink_device_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tplinkDevice->delete();

        return back();
    }

    public function massDestroy(MassDestroyTplinkDeviceRequest $request)
    {
        TplinkDevice::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
