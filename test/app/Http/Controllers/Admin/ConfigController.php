<?php

namespace App\Http\Controllers\Admin;

use App\Config;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyConfigRequest;
use App\Http\Requests\StoreConfigRequest;
use App\Http\Requests\UpdateConfigRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConfigController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('config_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $configs = Config::all();

        return view('admin.configs.index', compact('configs'));
    }

    public function create()
    {
        abort_if(Gate::denies('config_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.configs.create');
    }

    public function store(StoreConfigRequest $request)
    {
        $config = Config::create($request->all());

        return redirect()->route('admin.configs.index');
    }

    public function edit(Config $config)
    {
        abort_if(Gate::denies('config_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.configs.edit', compact('config'));
    }

    public function update(UpdateConfigRequest $request, Config $config)
    {
        $config->update($request->all());

        return redirect()->route('admin.configs.index');
    }

    public function show(Config $config)
    {
        abort_if(Gate::denies('config_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.configs.show', compact('config'));
    }

    public function destroy(Config $config)
    {
        abort_if(Gate::denies('config_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $config->delete();

        return back();
    }

    public function massDestroy(MassDestroyConfigRequest $request)
    {
        Config::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
