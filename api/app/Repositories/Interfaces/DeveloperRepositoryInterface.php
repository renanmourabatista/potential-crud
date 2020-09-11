<?php

namespace App\Repositories\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface DeveloperRepositoryInterface extends RepositoryInterface
{
    public function search(array $parameters): LengthAwarePaginator;
}