<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTplinkRequest;
use App\Http\Requests\UpdateTplinkRequest;
use App\Http\Resources\Admin\TplinkResource;
use App\Tplink;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TplinkApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tplink_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TplinkResource(Tplink::with(['updated_by'])->get());
    }

    public function store(StoreTplinkRequest $request)
    {
        $tplink = Tplink::create($request->all());

        return (new TplinkResource($tplink))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Tplink $tplink)
    {
        abort_if(Gate::denies('tplink_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TplinkResource($tplink->load(['updated_by']));
    }

    public function update(UpdateTplinkRequest $request, Tplink $tplink)
    {
        $tplink->update($request->all());

        return (new TplinkResource($tplink))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Tplink $tplink)
    {
        abort_if(Gate::denies('tplink_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tplink->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
