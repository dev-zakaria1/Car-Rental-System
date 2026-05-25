<?php

namespace App\Http\Requests\testimonials;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTestimonialRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_name' => 'required|string|max:150',
            'user_title' => 'nullable|string|max:150',
            'avatar_url' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'content' => 'required|string|max:500',
            'rating' => 'nullable|integer|min:1|max:5',
            'is_visible' => 'nullable|boolean',
        ];
    }
}
