<?php

namespace App\Domain\Articles\Repositories;

use App\Domain\Articles\Models\Article;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ArticleRepositoryInterface
{
    public function all(): Collection;
    public function find(string $id): Article;
    public function create(array $data): Article;
    public function update(string $id, array $data): Article;
    public function delete(string $id): void;
    public function paginate(int $perPage, int $page): LengthAwarePaginator;
}
