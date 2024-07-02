<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'price',
        'brandId',
        'stock',
        'description',
        'available',
        'image1',
        'image2',
        'image3',
        'image4',
        'image5',
        'views', 
    ];

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand', 'brandId');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}

