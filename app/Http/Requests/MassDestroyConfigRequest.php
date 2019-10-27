<?php

namespace App\Http\Requests;

use App\Config;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyConfigRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('config_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:configs,id',
        ];
    }
}
