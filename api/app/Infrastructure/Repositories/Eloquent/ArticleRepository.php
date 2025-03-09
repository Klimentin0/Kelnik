<?php

namespace App\Infrastructure\Repositories\Eloquent;

use App\Domain\Articles\Models\Article;
use App\Domain\Articles\Repositories\ArticleRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ArticleRepository implements ArticleRepositoryInterface
{
    public function all(): Collection
    {
        return Article::all();
    }

    public function find(string $id): Article
    {
        return Article::findOrFail($id);
    }

    public function create(array $data): Article
    {
        return Article::create($data);
    }

    public function update(string $id, array $data): Article
    {
        $article = Article::findOrFail($id);
        $article->update($data);
        return $article->fresh();
    }

    public function delete(string $id): void
    {
        Article::findOrFail($id)->delete();
    }
    public function paginate(int $perPage, int $page): LengthAwarePaginator
    {
        return Article::paginate(
            perPage: $perPage,
            columns: ['*'],
            pageName: 'page',
            page: $page
        );
    }
}
