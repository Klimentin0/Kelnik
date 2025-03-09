<?php

namespace App\Http\Requests\Articles;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'sometimes|string|max:255',
            'author' => 'sometimes|string|max:100|nullable',
            'brief' => 'sometimes|string|max:500',
            'full_text' => 'sometimes|string',
        ];
    }
}
