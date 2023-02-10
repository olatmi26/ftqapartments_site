<?php

namespace App\Http\Requests\Property\Apartment;

use Illuminate\Foundation\Http\FormRequest;

class FeeUpdateRequest extends FormRequest
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
            'other_fees' => ['numeric', 'between:-99.99999,99.99999'],
            'apartment_id' => ['integer', 'exists:apartments,id'],
        ];
    }
}
