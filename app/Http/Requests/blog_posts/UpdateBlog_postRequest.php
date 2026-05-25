<?php

namespace App\Http\Requests\blog_posts;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBlog_postRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('blog_post'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $post = $this->route('blog_post');
        $postId = $post->id;
        return [
            'title' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blog_posts,slug,' . $postId,
            'excerpt' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'author_id' => 'nullable|exists:users,id',
            'published_at' => 'nullable|date',
            'is_published' => 'boolean',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ];
    }
}
