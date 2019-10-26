<?php

namespace App\Http\Requests;

use App\TplinkDevice;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTplinkDeviceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('tplink_device_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:tplink_devices,id',
        ];
    }
}
