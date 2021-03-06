<?php

namespace App\Http\Requests;

use App\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'first_name' => [
                'min:2',
                'max:85',
                'required',
            ],
            'last_name'  => [
                'min:2',
                'max:85',
                'required',
            ],
            'name'       => [
                'required',
            ],
            'email'      => [
                'required',
            ],
            'password'   => [
                'required',
            ],
            'roles.*'    => [
                'integer',
            ],
            'roles'      => [
                'required',
                'array',
            ],
        ];
    }
}
