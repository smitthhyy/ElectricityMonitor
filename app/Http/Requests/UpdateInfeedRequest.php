<?php

namespace App\Http\Requests;

use App\Infeed;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateInfeedRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('infeed_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'timestamp' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'phase_1'   => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'phase_2'   => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'phase_3'   => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'total'     => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
