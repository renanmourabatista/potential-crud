<?php

namespace App\Services;

use App\Models\Developer;
use App\Repositories\Interfaces\DeveloperRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DeveloperService
{
    private DeveloperRepositoryInterface $repository;

    /**
     * DeveloperService constructor.
     * @param DeveloperRepositoryInterface $repository
     */
    public function __construct(DeveloperRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(array $data): array
    {
        $developer = $this->repository->create($data);

        return [
            'message' => trans('messages.developers.create_success'),
            'data'    => $developer
        ];
    }

    public function update(array $data, int $id): array
    {
        $developer = $this->repository->update($data, $id);

        if (!$developer) {
            throw new NotFoundHttpException(trans('exceptions.developers.not_found'));
        }

        return [
            'message' => trans('messages.developers.update_success'),
            'data'    => $developer
        ];
    }

    public function remove(int $id): array
    {
        $deleted = $this->repository->delete($id);

        if (!$deleted) {
            throw new BadRequestHttpException(trans('exceptions.developers.remove_error'));
        }

        return [
            'message' => trans('messages.developers.remove_success')
        ];
    }

    public function getById(int $id): ?Developer
    {
        $developer = $this->repository->getById($id);

        if (!$developer) {
            throw new NotFoundHttpException(trans('exceptions.developers.not_found'));
        }

        return $developer;
    }

    public function search(array $data): LengthAwarePaginator
    {
        $result = $this->repository->search($data);

        if($result->isEmpty()) {
            throw new NotFoundHttpException(trans('exceptions.developers.not_found'));
        }

        return $result;
    }
}