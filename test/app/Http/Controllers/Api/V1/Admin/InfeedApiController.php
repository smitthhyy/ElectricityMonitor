<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInfeedRequest;
use App\Http\Requests\UpdateInfeedRequest;
use App\Http\Resources\Admin\InfeedResource;
use App\Infeed;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InfeedApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('infeed_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InfeedResource(Infeed::all());
    }

    public function store(StoreInfeedRequest $request)
    {
        $infeed = Infeed::create($request->all());

        return (new InfeedResource($infeed))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Infeed $infeed)
    {
        abort_if(Gate::denies('infeed_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InfeedResource($infeed);
    }

    public function update(UpdateInfeedRequest $request, Infeed $infeed)
    {
        $infeed->update($request->all());

        return (new InfeedResource($infeed))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Infeed $infeed)
    {
        abort_if(Gate::denies('infeed_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $infeed->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
