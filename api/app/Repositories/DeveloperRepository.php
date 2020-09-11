<?php

namespace App\Repositories;

use App\Models\Developer;
use App\Repositories\Interfaces\DeveloperRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class DeveloperRepository implements DeveloperRepositoryInterface
{
    public function model(): string
    {
        return Developer::class;
    }

    public function getById(int $id): ?Developer
    {
        return $this->model()::find($id);
    }

    public function delete(int $id): bool
    {
        $developer = $this->find($id);

        if(!$developer) {
            return false;
        }

        return $developer->delete();
    }

    public function create(array $parameters): Developer
    {
        return $this->model()::create($parameters);
    }

    public function update(array $parameters, int $id): Developer
    {
        $developer = $this->find($id);
        $developer->update($parameters);

        return $developer;
    }

    public function search(array $data): LengthAwarePaginator
    {
        // TODO: Implement search() method.
    }
}