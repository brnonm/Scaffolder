<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsersRequest extends FormRequest
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
            'name' => 'required',
'email_verified_at' => 'required',
'password' => 'required',
'remember_token' => 'required',
'created_at' => 'required',
'updated_at' => 'required',
'type' => 'required',
'active' => 'required',
'photo' => 'required',
'nif' => 'required'
        ];
    }
}
