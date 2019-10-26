<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Config;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConfigRequest;
use App\Http\Requests\UpdateConfigRequest;
use App\Http\Resources\Admin\ConfigResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConfigApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('config_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ConfigResource(Config::all());
    }

    public function store(StoreConfigRequest $request)
    {
        $config = Config::create($request->all());

        return (new ConfigResource($config))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Config $config)
    {
        abort_if(Gate::denies('config_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ConfigResource($config);
    }

    public function update(UpdateConfigRequest $request, Config $config)
    {
        $config->update($request->all());

        return (new ConfigResource($config))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Config $config)
    {
        abort_if(Gate::denies('config_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $config->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
