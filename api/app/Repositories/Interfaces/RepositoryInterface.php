<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function model(): string;

    public function getById(int $id): ?Model;

    public function delete(int $id): bool;

    public function create(array $parameters): Model;

    public function update(array $parameters, int $id): Model;
}