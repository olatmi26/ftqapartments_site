<?php

namespace App\Models\Apartment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'apartment_id',
        'booking_id',
        'user_id',
        'amount',
        'paymentMethod',
        'ref',
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
        'booking_id' => 'integer',
        'user_id' => 'integer',
        'amount' => 'double',
        'status' => 'boolean',
    ];

    public function apartment()
    {
        return $this->belongsTo(\App\Models\Property\Apartment::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
