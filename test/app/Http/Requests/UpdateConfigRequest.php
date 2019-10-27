<?php

namespace App\Http\Requests;

use App\Config;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateConfigRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('config_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name'  => [
                'min:2',
                'max:64',
                'required',
                'unique:configs,name,' . request()->route('config')->id,
            ],
            'value' => [
                'max:128',
            ],
        ];
    }
}
