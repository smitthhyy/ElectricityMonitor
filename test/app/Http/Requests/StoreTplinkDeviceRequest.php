<?php

namespace App\Http\Requests;

use App\TplinkDevice;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreTplinkDeviceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('tplink_device_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'mac'   => [
                'min:12',
                'max:12',
                'required',
                'unique:tplink_devices',
            ],
            'alias' => [
                'max:80',
            ],
            'ip'    => [
                'max:15',
            ],
            'port'  => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
