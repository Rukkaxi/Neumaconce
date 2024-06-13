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
    public static function getBrands()
    {
        return self::select('brand')->distinct()->get();
    }

    public static function getModels($brand)
    {
        return self::select('model')->where('brand', $brand)->distinct()->get();
    }

    public static function getYears($brand, $model)
    {
        return self::select('year')->where('brand', $brand)->where('model', $model)->distinct()->get();
    }
}
