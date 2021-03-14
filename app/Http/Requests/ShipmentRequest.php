<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShipmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        switch (strtolower($this->get('category'))) {
            case 'pets':
                $rules = [
                    'pickup_date' => 'required|date',
                    'delivery_date' => 'required|date',
                    'pickup_location' => 'required|string',
                    'delivery_location' => 'required|string',
                    'description' => 'required|string',
                    'estimated_amount' => '',
                    'pet_name' => 'required|string',
                    'pet_weight' => 'required|string',
                    'pet_breed' => 'required|string',
                    'is_aggressive' => 'required|bool',
                ];
                break;
            case 'boats':
                $rules = [
                    'pickup_date' => 'required|date',
                    'delivery_date' => 'required|date',
                    'pickup_location' => 'required|string',
                    'delivery_location' => 'required|string',
                    'description' => 'required|string',
                    'estimated_amount' => '',
                    'boat_type' => 'required|string'
                ];
                break;
            case 'motorcycles':
            case 'cars':
                $rules = [
                    'pickup_date' => 'required|date',
                    'delivery_date' => 'required|date',
                    'pickup_location' => 'required|string',
                    'delivery_location' => 'required|string',
                    'description' => 'required|string',
                    'estimated_amount' => '',
                    'make' => 'required|string',
                    'model' => 'required|string',
                    'year' => 'required|string'
                ];
        }

        return $rules;
    }
}
