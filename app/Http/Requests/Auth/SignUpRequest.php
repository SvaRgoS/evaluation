<?php

namespace App\Http\Requests\Auth;

use App\Contracts\UsersPermissions;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:25',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            "permissions" => "required|array|min:1|max:3",
            "permissions.*" => ['required', 'string',
                Rule::in([
                    UsersPermissions::READ,
                    UsersPermissions::WRITE,
                    UsersPermissions::REMOVE
                ])
            ],
        ];
    }
}
