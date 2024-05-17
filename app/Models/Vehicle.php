<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = ['model', 'name', 'year', 'brandId'];
    public function brand()
    {
        return $this->belongsTo('App\Models\Brand', 'brandId');
    }
}
