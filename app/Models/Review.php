<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model {
    use HasFactory;

    protected $fillable = [
        'property_id',
        'client_name',
        'client_role',
        'client_image',
        'rating',
        'comment',
        'is_published'
    ];

    public function property() {
        return $this->belongsTo(Property::class);
    }
}