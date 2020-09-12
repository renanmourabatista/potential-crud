<?php

namespace Tests\Unit\Validation\Request\Developer;

use App\Http\Requests\SaveDeveloperRequest;
use Tests\Unit\Validation\Request\AbstractRequestTest;

class SaveDeveloperRequestTest extends AbstractRequestTest
{
    public function setUp():void
    {
        parent::setUp();

        $request               = new SaveDeveloperRequest();
        $this->requestRules    = $request->rules();
        $this->requestMessages = $request->messages();
    }

    public function expectedRules(): array
    {
        return [
            [['nome' => 'required']],
            [['sexo' => 'required|in:M,F']],
            [['idade' => 'required|numeric']],
            [['hobby' => 'required']],
            [['data_nascimento' => 'required|date_format:Y-m-d']],
        ];
    }

    public function expectedMessages(): array
    {
        $this->createApplication();

        return [
            [['nome.required' => trans('messages.developers.validation.nome_required')]],
            [['sexo.required' => trans('messages.developers.validation.sexo_required')]],
            [['sexo.in' => trans('messages.developers.validation.sexo_in')]],
            [['idade.required' => trans('messages.developers.validation.idade_required')]],
            [['idade.numeric' => trans('messages.developers.validation.idade_numeric')]],
            [['hobby.required' => trans('messages.developers.validation.hobby_required')]],
            [['data_nascimento.required' => trans('messages.developers.validation.data_nascimento_required')]],
            [['data_nascimento.date_format' => trans('messages.developers.validation.data_nascimento_date_format')]],
        ];
    }
}