<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Articles\ArticleController;

Route::prefix('v1')->group(function () {
    Route::apiResource('article', ArticleController::class)
        ->only(['index', 'store', 'show', 'update', 'destroy']);
});
