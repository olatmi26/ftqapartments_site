<?php

namespace App\Models\Apartment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'apartment_id',
        'user_id',
        'cart_id',
        'dateNeeded',
        'dateToArrive',
        'dateToParkin',
        'AcceptingTerms',
        'amountPaid',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'apartment_id' => 'integer',
        'user_id' => 'integer',
        'cart_id' => 'integer',
        'dateNeeded' => 'date',
        'dateToArrive' => 'date',
        'dateToParkin' => 'date',
        'AcceptingTerms' => 'boolean',
        'amountPaid' => 'double',
        'status' => 'boolean',
    ];

    public function apartment()
    {
        return $this->belongsTo(\App\Models\Property\Apartment::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
