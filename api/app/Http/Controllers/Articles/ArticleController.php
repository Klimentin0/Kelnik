<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;
use App\Http\Requests\Articles\CreateArticleRequest;
use App\Http\Requests\Articles\UpdateArticleRequest;
use App\Domain\Articles\Services\ArticleService;
use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
    public function __construct(
        private readonly ArticleService $articleService
    ) {
    }

    public function index(): JsonResponse
    {
        try {
            $articles = $this->articleService->getAll();
            return response()->json(['data' => $articles]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(CreateArticleRequest $request): JsonResponse
    {
        try {
            $article = $this->articleService->create(
                $request->validated()
            );
            return response()->json(['data' => $article], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show(string $id): JsonResponse
    {
        try {
            $article = $this->articleService->getById($id);
            return response()->json(['data' => $article]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function update(UpdateArticleRequest $request, string $id): JsonResponse
    {
        try {
            $article = $this->articleService->update(
                $id,
                $request->validated()
            );
            return response()->json(['data' => $article]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(string $id): JsonResponse
    {
        try {
            $this->articleService->delete($id);
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
