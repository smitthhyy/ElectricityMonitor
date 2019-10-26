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
use Yajra\DataTables\Facades\DataTables;

class TplinkDevicesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = TplinkDevice::with(['updated_by'])->select(sprintf('%s.*', (new TplinkDevice)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'tplink_device_show';
                $editGate      = 'tplink_device_edit';
                $deleteGate    = 'tplink_device_delete';
                $crudRoutePart = 'tplink-devices';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('mac', function ($row) {
                return $row->mac ? $row->mac : "";
            });
            $table->editColumn('alias', function ($row) {
                return $row->alias ? $row->alias : "";
            });
            $table->editColumn('ip', function ($row) {
                return $row->ip ? $row->ip : "";
            });
            $table->editColumn('port', function ($row) {
                return $row->port ? $row->port : "";
            });
            $table->editColumn('online', function ($row) {
                return $row->online ? TplinkDevice::ONLINE_RADIO[$row->online] : '';
            });
            $table->addColumn('updated_by_email', function ($row) {
                return $row->updated_by ? $row->updated_by->email : '';
            });

            $table->editColumn('updated_by.first_name', function ($row) {
                return $row->updated_by ? (is_string($row->updated_by) ? $row->updated_by : $row->updated_by->first_name) : '';
            });
            $table->editColumn('updated_by.last_name', function ($row) {
                return $row->updated_by ? (is_string($row->updated_by) ? $row->updated_by : $row->updated_by->last_name) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'updated_by']);

            return $table->make(true);
        }

        return view('admin.tplinkDevices.index');
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
