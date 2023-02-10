<?php

namespace App\Http\Requests\Property\Apartment;

use Illuminate\Foundation\Http\FormRequest;

class ApartmentLeasePeriodStoreRequest extends FormRequest
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
            'lease_period_id' => ['integer', 'exists:lease_periods,id'],
        ];
    }
}
