<?php

namespace App\Http\Requests;

use App\Tplink;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateTplinkRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('tplink_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'mac'        => [
                'min:12',
                'max:12',
                'required',
                'unique:tplinks,mac,' . request()->route('tplink')->id,
            ],
            'timestamp'  => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'voltage_mv' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'current_ma' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'power_mw'   => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'total_wh'   => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
