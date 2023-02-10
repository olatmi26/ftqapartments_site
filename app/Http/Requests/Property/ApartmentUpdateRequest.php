<?php

namespace App\Http\Requests\Property;

use Illuminate\Foundation\Http\FormRequest;

class ApartmentUpdateRequest extends FormRequest
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
            'propertyID' => ['string', 'max:6', 'unique:apartments,propertyID'],
            'category_id' => ['integer', 'exists:categories,id'],
            'state_id' => ['integer', 'exists:states,id'],
            'title' => ['string'],
            'location' => ['string'],
            'city' => ['string'],
            'nearByCities' => ['string'],
            'number_of_room' => ['integer'],
            'pricePerMonth' => ['numeric', 'between:-9.999999,9.999999'],
            'pricePerYear' => ['numeric', 'between:-9.999999,9.999999'],
            'description' => ['string'],
            'mapStreetLatitude' => ['numeric', 'between:-9.999999,9.999999'],
            'mapStreetLongitude' => ['numeric', 'between:-9.999999,9.999999'],
            'majorBusStop' => ['string'],
            'nearbyBusStop' => ['string'],
            'nearByShoppingMall' => ['string'],
            'availability' => [''],
            'enteredBy' => [''],
        ];
    }
}
