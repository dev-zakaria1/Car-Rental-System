<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (Auth::check()) {
            return true;
        };
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(Request $request): array
    {
        return [
            'car_id'              => 'required|integer|exists:cars,id',
            // 'user_id'=>''
            'pickup_location_id'  => 'required|integer|exists:locations,id',
            'dropoff_location_id' => 'required|integer|exists:locations,id',
            'pickup_datetime'     => ['required', 'date','after_or_equal:' . now()->addHours(24)->toDateTimeString()],
            'dropoff_datetime'    => 'required|date|after:' . date('Y-m-d H:i:s', strtotime($request->pickup_datetime . ' +2 hour')),
            'notes'               => 'nullable|string|max:1000',
        ];
    }
}
