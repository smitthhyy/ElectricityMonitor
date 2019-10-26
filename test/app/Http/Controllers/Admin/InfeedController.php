<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyInfeedRequest;
use App\Http\Requests\StoreInfeedRequest;
use App\Http\Requests\UpdateInfeedRequest;
use App\Infeed;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class InfeedController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Infeed::query()->select(sprintf('%s.*', (new Infeed)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'infeed_show';
                $editGate      = 'infeed_edit';
                $deleteGate    = 'infeed_delete';
                $crudRoutePart = 'infeeds';

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
            $table->editColumn('timestamp', function ($row) {
                return $row->timestamp ? $row->timestamp : "";
            });
            $table->editColumn('ch_1', function ($row) {
                return $row->ch_1 ? $row->ch_1 : "";
            });
            $table->editColumn('ch_2', function ($row) {
                return $row->ch_2 ? $row->ch_2 : "";
            });
            $table->editColumn('ch_3', function ($row) {
                return $row->ch_3 ? $row->ch_3 : "";
            });
            $table->editColumn('sensor', function ($row) {
                return $row->sensor ? $row->sensor : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.infeeds.index');
    }

    public function create()
    {
        abort_if(Gate::denies('infeed_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.infeeds.create');
    }

    public function store(StoreInfeedRequest $request)
    {
        $infeed = Infeed::create($request->all());

        return redirect()->route('admin.infeeds.index');
    }

    public function edit(Infeed $infeed)
    {
        abort_if(Gate::denies('infeed_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.infeeds.edit', compact('infeed'));
    }

    public function update(UpdateInfeedRequest $request, Infeed $infeed)
    {
        $infeed->update($request->all());

        return redirect()->route('admin.infeeds.index');
    }

    public function show(Infeed $infeed)
    {
        abort_if(Gate::denies('infeed_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.infeeds.show', compact('infeed'));
    }

    public function destroy(Infeed $infeed)
    {
        abort_if(Gate::denies('infeed_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $infeed->delete();

        return back();
    }

    public function massDestroy(MassDestroyInfeedRequest $request)
    {
        Infeed::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
