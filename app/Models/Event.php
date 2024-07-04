<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'event'; // Especifica la tabla correcta
    
    protected $fillable = [
        'title', 'start', 'end'
    ];

    protected static function booted()
    {
        static::created(function ($event) {
            Notification::create([
                'message' => "Tienes un nuevo evento: {$event->title} del {$event->start} al {$event->end}",
                'date' => now(),
                'viewed' => false
            ]);
        });
    }
}


