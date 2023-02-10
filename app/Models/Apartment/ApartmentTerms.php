<?php

namespace App\Models\Apartment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApartmentTerms extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'apartment_id',
        'terms_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'apartment_id' => 'integer',
        'terms_id' => 'integer',
    ];

    public function apartment()
    {
        return $this->belongsTo(\App\Models\Property\Apartment::class);
    }

    public function terms()
    {
        return $this->belongsTo(Terms::class);
    }
}
