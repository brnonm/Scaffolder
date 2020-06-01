<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContasRequest extends FormRequest
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
                        'user_id' => 'required',
            'nome' => 'required|max:30',
            'descricao' => 'required|max:255',
            'saldo_abertura' => 'required|max:112',
            'saldo_atual' => 'required|max:112',
            'data_ultimo_movimento' => 'required',
            'deleted_at' => 'required',

        ];
    }
}
