<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'image_path',
        'image_name',
        'image_mime',
        'image_size',
        'is_primary',
        'sort_order',
        'caption',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'sort_order' => 'integer',
    ];

    // Relationship ngược lại Property
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
