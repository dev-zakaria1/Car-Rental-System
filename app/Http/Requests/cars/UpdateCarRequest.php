<?php

namespace App\Http\Requests\cars;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('car'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $car = $this->route('car');
        $carId = ($car instanceof \App\Models\Car) ? $car->id : $car;
        return [
            'category_id'     => 'required|exists:car_categories,id',
            'location_id'     => 'required|exists:locations,id',
            'make'            => 'required|string|max:100',
            'model'           => 'required|string|max:100',
            'year'            => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'registration_no' => "required|string|max:50|unique:cars,registration_no,$carId",
            'vin'             => "required|string|max:100|unique:cars,vin,$carId",
            'transmission'    => 'required|in:automatic,manual',
            'fuel_type'       => 'nullable|in:petrol,diesel,hybrid,electric,others',
            'doors'           => 'nullable|integer|min:1|max:10',
            'seats'           => 'nullable|integer|min:1|max:100',
            'luggage'         => 'nullable|integer|min:0|max:20',
            'color'           => 'nullable|string|max:50',
            'hour_rate'      => 'required|numeric|min:0|max:99999999.99',
            'image_url'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status'          => 'required|in:available,unavailable,maintenance,reserved',
        ];
    }
}
