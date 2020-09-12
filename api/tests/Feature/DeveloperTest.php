<?php


namespace Tests\Feature;


use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Response;
use Tests\FeatureTestCase;

class DeveloperTest extends FeatureTestCase
{
    use WithoutMiddleware;

    /**
     * @test
     */
    public function shouldCreatADeveloperWithSuccess()
    {
        $data = [
            'nome'            => $this->faker->name,
            'sexo'            => $this->faker->randomElement(['M', 'F']),
            'idade'           => $this->faker->numberBetween(1, 99),
            'hobby'           => $this->faker->word,
            'data_nascimento' => $this->faker->date()
        ];

        $response = $this->post('v1/developers', $data);

        $response->assertStatus(Response::HTTP_OK);
    }
}