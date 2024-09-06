<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function variations()
    {
        return $this->hasMany(Variation::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }
    public function images()
    {
        return $this->hasMany(ProductImages::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function averageReview()
    {
        return $this->reviews()->avg('star_rating');
    }
    public function latestImages()
    {
       return $this->hasOne(ProductImages::class)->latestOfMany();
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }


}
