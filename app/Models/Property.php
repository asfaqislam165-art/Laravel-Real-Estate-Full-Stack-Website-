<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model 
{
    protected $fillable = [
        'category_id', 
        'title', 
        'price', 
        'location', 
        'bedrooms', 
        'bathrooms', 
        'area_sqft', 
        'description', 
        'featured_image', 
        'is_featured', 
        'status'
    ];

    public function category() 
    { 
        return $this->belongsTo(Category::class); 
    }

    public function images() 
    { 
        return $this->hasMany(PropertyImage::class, 'property_id'); 
    }

    public function inquiries() 
    { 
        return $this->hasMany(Inquiry::class); 
    }

    public function reviews() 
    { 
        return $this->hasMany(Review::class, 'property_id'); 
    }
}