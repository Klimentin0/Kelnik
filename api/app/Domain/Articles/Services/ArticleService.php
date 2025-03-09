<?php

namespace App\Domain\Articles\Services;

use App\Domain\Articles\Exceptions\ArticleException;
use App\Domain\Articles\Models\Article;
use App\Domain\Articles\Repositories\ArticleRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ArticleService
{
    public function __construct(
        private readonly ArticleRepositoryInterface $articleRepository
    ) {
    }

    public function getAll(): Collection
    {
        return $this->articleRepository->all();
    }

    public function getById(string $id): Article
    {
        try {
            return $this->articleRepository->find($id);
        } catch (ModelNotFoundException $e) {
            throw new ArticleException('Article not found', 404);
        }
    }

    public function create(array $data): Article
    {
        return $this->articleRepository->create($data);
    }

    public function update(string $id, array $data): Article
    {
        return $this->articleRepository->update($id, $data);
    }

    public function delete(string $id): void
    {
        $this->articleRepository->delete($id);
    }
    public function getPaginated(int $perPage = 10, int $page = 1): LengthAwarePaginator
    {
        return $this->articleRepository->paginate($perPage, $page);
    }
}
