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

        $developer = Developer::factory()->make();

        $expectedResult = [
            'message' => trans('messages.developers.create_success'),
            'data'    => $developer
        ];

        $this->repository
            ->shouldReceive('create')
            ->with($data)
            ->andReturn($developer)
            ->once();

        $result = $this->service->create($data);

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @test
     */
    public function shouldRemoveADeveloper()
    {
        $id             = $this->faker->randomNumber(2);
        $expectedResult = [
            'message' => trans('messages.developers.remove_success')
        ];

        $this->repository
            ->shouldReceive('delete')
            ->with($id)
            ->andReturnTrue()
            ->once();

        $result = $this->service->remove($id);

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @test
     */
    public function shouldGetADeveloperById()
    {
        $id                = $this->faker->randomNumber(2);
        $expectedDeveloper = Developer::factory()->make();

        $this->repository
            ->shouldReceive('getById')
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
            ->shouldReceive('getById')
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
        $data      = [];
        $developer = Developer::factory()->make(['id' => $this->faker->randomDigit]);

        $expectedResult = [
            'message' => trans('messages.developers.update_success'),
            'data'    => $developer
        ];

        $this->repository
            ->shouldReceive('update')
            ->with($data, $developer->id)
            ->andReturn($developer)
            ->once();

        $result = $this->service->update($data, $developer->id);

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @test
     */
    public function shouldFailToUpdateADeveloperWhenNotExists()
    {
        $data = [];
        $id   = $this->faker->randomDigit;

        $this->expectException(NotFoundHttpException::class);
        $this->expectErrorMessage(trans('exceptions.developers.not_found'));

        $this->repository
            ->shouldReceive('update')
            ->with($data, $id)
            ->andReturnNull()
            ->once();

        $this->service->update($data, $id);
    }

    /**
     * @test
     */
    public function shouldSearchADeveloper()
    {
        $data           = [];
        $expectedResult = \Mockery::mock(LengthAwarePaginator::class);

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