<?php


namespace Tests\Unit\Services;

use App\Models\Developer;
use App\Repositories\DeveloperRepository;
use App\Repositories\Interfaces\DeveloperRepositoryInterface;
use App\Services\DeveloperService;
use Illuminate\Pagination\LengthAwarePaginator;
use Mockery;
use Mockery\MockInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\TestCase;

class DeveloperServiceTest extends TestCase
{
    private DeveloperService $service;

    private MockInterface $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository = Mockery::mock(DeveloperRepositoryInterface::class);

        $this->app->instance(DeveloperRepository::class, $this->repository);

        $this->service = $this->app->make(DeveloperService::class);
    }

    /**
     * @test
     */
    public function shouldCreateADeveloper()
    {
        $data = [];
        $expectedResult = Developer::factory()->make();

        $this->repository
            ->shouldReceive('create')
            ->with($data)
            ->andReturn($expectedResult)
            ->once();

        $result = $this->service->create($data);

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @test
     */
    public function shouldRemoveADeveloper()
    {
        $id = $this->faker->randomNumber(2);

        $this->repository
            ->shouldReceive('delete')
            ->with($id)
            ->andReturnTrue()
            ->once();

        $this->service->remove($id);
    }

    /**
     * @test
     */
    public function shouldGetADeveloperById()
    {
        $id                = $this->faker->randomNumber(2);
        $expectedDeveloper = Developer::factory()->make();

        $this->repository
            ->shouldReceive('find')
            ->with($id)
            ->andReturn($expectedDeveloper)
            ->once();

        $this->service->getById($id);
    }

    /**
     * @test
     */
    public function shouldFailToGetADeveloperById()
    {
        $this->expectException(NotFoundHttpException::class);
        $this->expectErrorMessage(trans('exceptions.developers.not_found'));

        $id = $this->faker->randomNumber(2);

        $this->repository
            ->shouldReceive('find')
            ->with($id)
            ->andReturnNull();

        $this->service->getById($id);
    }

    /**
     * @test
     */
    public function shouldFailToRemoveADeveloper()
    {
        $this->expectException(BadRequestHttpException::class);
        $this->expectErrorMessage(trans('exceptions.developers.remove_error'));

        $id = $this->faker->randomNumber(2);

        $this->repository
            ->shouldReceive('delete')
            ->with($id)
            ->andReturnFalse();

        $this->service->remove($id);
    }

    /**
     * @test
     */
    public function shouldUpdateADeveloper()
    {
        $data           = [];
        $expectedResult = Developer::factory()->make(['id' => $this->faker->randomDigit]);

        $this->repository
            ->shouldReceive('update')
            ->with($data, $expectedResult->id)
            ->andReturn($expectedResult)
            ->once();

        $result = $this->service->update($data, $expectedResult->id);

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @test
     */
    public function shouldSearchADeveloper()
    {
        $data           = [];
        $expectedResult =  \Mockery::mock(LengthAwarePaginator::class);

        $expectedResult
            ->shouldReceive('isEmpty')
            ->withNoArgs()
            ->andReturn(false)
            ->once();

        $this->repository
            ->shouldReceive('search')
            ->with($data)
            ->andReturn($expectedResult)
            ->once();

        $result = $this->service->search($data);

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @test
     */
    public function shouldFailToSearchADeveloper()
    {
        $this->expectException(NotFoundHttpException::class);
        $this->expectErrorMessage(trans('exceptions.developers.not_found'));

        $repositoryResult = \Mockery::mock(LengthAwarePaginator::class);
        $repositoryResult
            ->shouldReceive('isEmpty')
            ->withNoArgs()
            ->andReturn(true)
            ->once();

        $data = [];

        $this->repository
            ->shouldReceive('search')
            ->with($data)
            ->andReturn($repositoryResult)
            ->once();

        $this->service->search($data);
    }
}