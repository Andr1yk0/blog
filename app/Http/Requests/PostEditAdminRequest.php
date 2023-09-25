<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostEditAdminRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255'],
            'body_markdown' => ['required', 'string'],
            'body_html' => ['required', 'string'],
            'published_at' => ['nullable', 'date'],
            'tags' => ['required', 'array'],
        ];

        $rules['title'][] = 'unique:posts,title' . ($this->post ? ',' . $this->post->id : '');
        $rules['slug'][] = 'unique:posts,slug' . ($this->post ? ',' . $this->post->id : '');

        return $rules;
    }
}
