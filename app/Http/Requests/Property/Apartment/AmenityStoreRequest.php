<?php

namespace App\Http\Requests\Property\Apartment;

use Illuminate\Foundation\Http\FormRequest;

class AmenityStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'apartment_id' => ['integer', 'exists:apartments,id'],
            'No_of_bedrooms' => ['integer'],
            'apartment_id' => ['integer', 'exists:apartments,id'],
            'No_of_bedrooms' => ['integer'],
            'bath_rooms' => ['integer'],
            'square_Feet' => ['integer'],
            'apartment_id' => ['integer', 'exists:apartments,id'],
            'No_of_bedrooms' => ['integer'],
            'bath_rooms' => ['integer'],
            'square_Feet' => ['integer'],
        ];
    }
}
