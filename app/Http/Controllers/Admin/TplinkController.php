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

class TplinkController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tplink_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tplinks = Tplink::all();

        return view('admin.tplinks.index', compact('tplinks'));
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
