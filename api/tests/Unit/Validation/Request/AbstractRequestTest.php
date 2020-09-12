<?php

namespace Tests\Unit\Validation\Request;

use Tests\TestCase;

abstract class AbstractRequestTest extends TestCase
{
    protected array $requestRules = [];

    protected array $requestMessages = [];

    public function expectedRules(): array
    {
        return [];
    }

    public function expectedMessages(): array
    {
        return [];
    }

    /**
     * @test
     * @dataProvider expectedRules
     */
    public function shouldHaveExpectedRules($expectedRule)
    {
        $field      = key($expectedRule);
        $rule = [$field => $this->requestRules[$field]];

        $this->assertEquals($expectedRule, $rule);
    }

    /**
     * @test
     * @dataProvider expectedMessages
     */
    public function shouldHaveExpectedMessages($expectedMessage)
    {
        $field   = key($expectedMessage);
        $message = [$field => $this->requestMessages[$field]];

        $this->assertEquals($expectedMessage, $message);
    }
}