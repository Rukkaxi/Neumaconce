<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'regionId'];

    /**
     * Get the region that owns the commune.
     */
    public function region()
    {
        return $this->belongsTo('App\Models\Region', 'regionId');
        
    }
}
