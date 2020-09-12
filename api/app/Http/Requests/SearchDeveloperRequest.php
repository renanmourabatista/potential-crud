<?php

namespace App\Http\Requests;

class SearchDeveloperRequest extends AbstractRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sexo'            => 'in:M,F',
            'idade'           => 'numeric',
            'data_nascimento' => 'date_format:Y-m-d',
        ];
    }

    public function messages(): array
    {
        return [
            'sexo.in'                     => trans('messages.developers.validation.sexo_in'),
            'idade.numeric'               => trans('messages.developers.validation.idade_numeric'),
            'data_nascimento.date_format' => trans('messages.developers.validation.data_nascimento_date_format'),
        ];
    }
}