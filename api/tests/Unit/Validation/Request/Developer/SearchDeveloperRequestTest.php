<?php


namespace Tests\Unit\Validation\Request\Developer;

use App\Http\Requests\SearchDeveloperRequest;
use Tests\Unit\Validation\Request\AbstractRequestTest;

class SearchDeveloperRequestTest extends AbstractRequestTest
{
    public function setUp():void
    {
        parent::setUp();

        $request               = new SearchDeveloperRequest();
        $this->requestRules    = $request->rules();
        $this->requestMessages = $request->messages();
    }

    public function expectedRules(): array
    {
        return [
            [['sexo' => 'in:M,F']],
            [['idade' => 'numeric']],
            [['data_nascimento' => 'date_format:Y-m-d']],
        ];
    }

    public function expectedMessages(): array
    {
        $this->createApplication();

        return [
            [['sexo.in' => trans('messages.developers.validation.sexo_in')]],
            [['idade.numeric' => trans('messages.developers.validation.idade_numeric')]],
            [['data_nascimento.date_format' => trans('messages.developers.validation.data_nascimento_date_format')]],
        ];
    }
}