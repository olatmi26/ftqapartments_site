<?php

namespace App\Models\Property;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'propertyID',
        'category_id',
        'state_id',
        'title',
        'location',
        'city',
        'nearByCities',
        'number_of_room',
        'pricePerMonth',
        'pricePerYear',
        'description',
        'mapStreetLatitude',
        'mapStreetLongitude',
        'majorBusStop',
        'nearbyBusStop',
        'nearByShoppingMall',
        'availability',
        'enteredBy',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'category_id' => 'integer',
        'state_id' => 'integer',
        'pricePerMonth' => 'decimal:6',
        'pricePerYear' => 'decimal:6',
        'mapStreetLatitude' => 'decimal:6',
        'mapStreetLongitude' => 'decimal:6',
        'availability' => 'boolean',
        'enteredBy' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }

    public function state()
    {
        return $this->belongsTo(\App\Models\State::class);
    }

    public function propertyEnteredBy()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}