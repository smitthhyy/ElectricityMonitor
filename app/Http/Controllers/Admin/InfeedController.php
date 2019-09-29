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

class InfeedController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('infeed_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $infeeds = Infeed::all();

        return view('admin.infeeds.index', compact('infeeds'));
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

        $infeed->load('updated_by');

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

        $infeed->load('updated_by');

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
