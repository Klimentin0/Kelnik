<?php

namespace App\Providers;

use App\Domain\Articles\Repositories\ArticleRepositoryInterface;
use App\Infrastructure\Repositories\Eloquent\ArticleRepository;
use Illuminate\Support\ServiceProvider;

class DomainServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            ArticleRepositoryInterface::class,
            ArticleRepository::class
        );
    }
}
