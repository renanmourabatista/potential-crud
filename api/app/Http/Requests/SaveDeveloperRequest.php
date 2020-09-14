<?php

namespace App\Http\Requests;

class SaveDeveloperRequest extends AbstractRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome'            => 'required',
            'sexo'            => 'required|in:M,F',
            'idade'           => 'required|numeric|idade_compativel',
            'hobby'           => 'required',
            'data_nascimento' => 'required|date_format:Y-m-d',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required'               => trans('messages.developers.validation.nome_required'),
            'sexo.required'               => trans('messages.developers.validation.sexo_required'),
            'sexo.in'                     => trans('messages.developers.validation.sexo_in'),
            'idade.required'              => trans('messages.developers.validation.idade_required'),
            'idade.numeric'               => trans('messages.developers.validation.idade_numeric'),
            'idade.idade_compativel'      => trans('messages.developers.validation.idade_compativel'),
            'hobby.required'              => trans('messages.developers.validation.hobby_required'),
            'data_nascimento.required'    => trans('messages.developers.validation.data_nascimento_required'),
            'data_nascimento.date_format' => trans('messages.developers.validation.data_nascimento_date_format'),
        ];
    }
}