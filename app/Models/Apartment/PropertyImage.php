<?php

namespace App\Models\Apartment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'apartment_id',
        'image_url',
        'imageName',
        'isFeatured',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'apartment_id' => 'integer',
        'isFeatured' => 'boolean',
    ];

    public function apartment()
    {
        return $this->belongsTo(\App\Models\Property\Apartment::class);
    }
}
