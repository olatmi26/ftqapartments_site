<?php

namespace App\Http\Requests\Apartment;

use Illuminate\Foundation\Http\FormRequest;

class BookingUpdateRequest extends FormRequest
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
            'user_id' => ['integer', 'exists:users,id'],
            'cart_id' => ['integer', 'exists:carts,id'],
            'dateNeeded' => ['date'],
            'dateToArrive' => ['date'],
            'dateToParkin' => ['date'],
            'AcceptingTerms' => [''],
            'amountPaid' => ['numeric', 'between:-999999.99,999999.99'],
            'status' => [''],
        ];
    }
}
