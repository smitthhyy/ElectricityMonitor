<?php

namespace App\Http\Requests;

use App\Config;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreConfigRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('config_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name'  => [
                'min:2',
                'max:64',
                'required',
                'unique:configs',
            ],
            'value' => [
                'max:128',
            ],
        ];
    }
}
