<?php

namespace App\Http\Requests\Apartment;

use Illuminate\Foundation\Http\FormRequest;

class PaymentUpdateRequest extends FormRequest
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
            'booking_id' => ['integer', 'exists:bookings,id'],
            'user_id' => ['integer', 'exists:users,id'],
            'amount' => ['numeric'],
            'paymentMethod' => ['string'],
            'ref' => ['string'],
            'status' => [''],
        ];
    }
}
