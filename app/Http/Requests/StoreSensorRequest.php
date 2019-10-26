<?php

namespace App\Http\Requests;

use App\Sensor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreSensorRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('sensor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name'     => [
                'required',
                'unique:sensors',
            ],
            'id_field' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
