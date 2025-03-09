<?php

namespace App\Http\Requests\Articles;

use Illuminate\Foundation\Http\FormRequest;

class CreateArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'author' => 'sometimes|string|max:100|nullable',
            'brief' => 'required|string|max:500',
            'full_text' => 'required|string',
        ];
    }
}
