<?php

namespace App\Repositories;

use App\Models\Developer;
use App\Repositories\Interfaces\DeveloperRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class DeveloperRepository implements DeveloperRepositoryInterface
{
    private array $likableFields = [
        'nome',
        'hobby'
    ];

    private array $exactlyMatchFields = [
        'idade',
        'sexo',
        'data_nascimento'
    ];

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
        $developer = $this->getById($id);

        if(!$developer) {
            return false;
        }

        return $developer->delete();
    }

    public function create(array $parameters): Developer
    {
        return $this->model()::create($parameters);
    }

    public function update(array $parameters, int $id): ?Developer
    {
        $developer = $this->getById($id);

        if(!$developer) {
            return null;
        }

        $developer->update($parameters);

        return $developer;
    }

    public function search(array $data): LengthAwarePaginator
    {
        $queryBuilder          = $this->model()::query();
        $itensPerPage          = 10;

        foreach ($data as $field => $value) {
            if(in_array($field, $this->exactlyMatchFields)) {
                $queryBuilder->where($field, '=', $value);
            }

            if(in_array($field, $this->likableFields)) {
                $queryBuilder->where($field, 'like', '%'. $value.'%');
            }
        }

        return $queryBuilder->orderBy('id', 'DESC')->paginate($itensPerPage);
    }
}