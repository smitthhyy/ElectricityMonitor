<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTplinkRequest;
use App\Http\Requests\StoreTplinkRequest;
use App\Http\Requests\UpdateTplinkRequest;
use App\Tplink;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TplinkController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Tplink::with(['updated_by'])->select(sprintf('%s.*', (new Tplink)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'tplink_show';
                $editGate      = 'tplink_edit';
                $deleteGate    = 'tplink_delete';
                $crudRoutePart = 'tplinks';

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
            $table->editColumn('timestamp', function ($row) {
                return $row->timestamp ? $row->timestamp : "";
            });
            $table->editColumn('voltage_mv', function ($row) {
                return $row->voltage_mv ? $row->voltage_mv : "";
            });
            $table->editColumn('current_ma', function ($row) {
                return $row->current_ma ? $row->current_ma : "";
            });
            $table->editColumn('power_mw', function ($row) {
                return $row->power_mw ? $row->power_mw : "";
            });
            $table->editColumn('total_wh', function ($row) {
                return $row->total_wh ? $row->total_wh : "";
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

        return view('admin.tplinks.index');
    }

    public function create()
    {
        abort_if(Gate::denies('tplink_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tplinks.create');
    }

    public function store(StoreTplinkRequest $request)
    {
        $tplink = Tplink::create($request->all());

        return redirect()->route('admin.tplinks.index');
    }

    public function edit(Tplink $tplink)
    {
        abort_if(Gate::denies('tplink_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tplink->load('updated_by');

        return view('admin.tplinks.edit', compact('tplink'));
    }

    public function update(UpdateTplinkRequest $request, Tplink $tplink)
    {
        $tplink->update($request->all());

        return redirect()->route('admin.tplinks.index');
    }

    public function show(Tplink $tplink)
    {
        abort_if(Gate::denies('tplink_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tplink->load('updated_by');

        return view('admin.tplinks.show', compact('tplink'));
    }

    public function destroy(Tplink $tplink)
    {
        abort_if(Gate::denies('tplink_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tplink->delete();

        return back();
    }

    public function massDestroy(MassDestroyTplinkRequest $request)
    {
        Tplink::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
