<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'property_type_id',
        'location_id',
        'title',
        'slug',
        'description',
        'address',
        'price',
        'price_type',
        'currency',
        'price_negotiable',
        'area',
        'width',
        'length',
        'bedrooms',
        'bathrooms',
        'floors',
        'parking_spaces',
        'direction',
        'feng_shui',
        'status',
        'is_featured',
        'is_hot',
        'publish_date',
        'expire_date',
        'latitude',
        'longitude',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'views_count',
        'favorites_count',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_hot' => 'boolean',
        'price_negotiable' => 'boolean',
        'price' => 'decimal:2',
        'area' => 'decimal:2',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }
}
