<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'summary', 'description', 'price', 
    'discounted_price', 'images', 'category_id', 'brand_id', 'status', 'featured'];

    protected $casts = [
        'images' => 'array'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function thumbnail(): Attribute {
        return Attribute::get(function($value, $attrib) {
            return json_decode($attrib['images'])[0];
        });
    }
}
