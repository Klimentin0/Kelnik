<?php

namespace App\Domain\Articles\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\ArticleFactory;

class Article extends Model
{
    use HasFactory;
    protected static function newFactory()
    {
        return ArticleFactory::new();
    }

    protected $fillable = [
        'title',
        'author',
        'brief',
        'full_text'
    ];

    protected $casts = [];
}
