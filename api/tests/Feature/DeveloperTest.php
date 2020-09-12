<?php

namespace Tests\Feature;

use App\Models\Developer;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Response;
use Tests\FeatureTestCase;

class DeveloperTest extends FeatureTestCase
{
    use WithoutMiddleware;

    private Developer $developer;

    public function setUp(): void
    {
        parent::setUp();

        $this->developer = Developer::factory()->create();
    }

    /**
     * @test
     */
    public function shouldCreateADeveloperWithSuccess()
    {
        $data = [
            'nome'            => $this->faker->name,
            'sexo'            => $this->faker->randomElement(['M', 'F']),
            'idade'           => $this->faker->numberBetween(1, 99),
            'hobby'           => $this->faker->word,
            'data_nascimento' => $this->faker->date()
        ];

        $response = $this->post('api/developers', $data);

        $response->assertStatus(Response::HTTP_CREATED);
    }

    /**
     * @test
     */
    public function shouldUpdateADeveloperWithSuccess()
    {
        $data = [
            'nome'            => $this->faker->name,
            'sexo'            => $this->faker->randomElement(['M', 'F']),
            'idade'           => $this->faker->numberBetween(1, 99),
            'hobby'           => $this->faker->word,
            'data_nascimento' => $this->faker->date()
        ];

        $response = $this->put('api/developers/'.$this->developer->id, $data);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson(['data' => array_merge($data, ['id' => $this->developer->id])]);
    }

    /**
     * @test
     */
    public function shouldRemoveADeveloperWithSuccess()
    {
        $developer = Developer::factory()->create();

        $response = $this->delete('api/developers/'.$developer->id);

        $response->assertStatus(Response::HTTP_NO_CONTENT);
    }

    /**
     * @test
     */
    public function shouldGetADeveloperWithSuccess()
    {
        $developer = Developer::factory()->create();

        $response = $this->get('api/developers/'.$developer->id);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertExactJson(['data' => $developer->toArray()]);
    }

    /**
     * @test
     */
    public function shouldSearchADeveloperByFilter()
    {
        $developer = Developer::factory()->create();

        $filters = $developer->toArray();

        $queryString = http_build_query($filters);

        $response = $this->get('api/developers?'.$queryString);

        $response->assertStatus(Response::HTTP_OK);
    }
}