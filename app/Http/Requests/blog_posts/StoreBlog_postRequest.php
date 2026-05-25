<?php

namespace App\Http\Requests\blog_posts;

use App\Models\blog_post;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBlog_postRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', blog_post::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
       
        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blog_posts,slug,',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'author_id' => 'required|exists:users,id',
            'published_at' => 'required|date',
            'is_published' => 'boolean',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ];
    }
}
