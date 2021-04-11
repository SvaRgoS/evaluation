<?php

namespace App\Http\Requests\Auth;

use App\Contracts\UsersPermissions;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('api')->user()->id == $this->request->get('id');
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
