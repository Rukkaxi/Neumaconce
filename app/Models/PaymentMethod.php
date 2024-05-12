<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;
    protected $table = 'metodo_pago'; // Nombre de la tabla en la base de datos
    public $timestamps = false;
    
    protected $fillable = [
        'nombre',
        'descripcion',
        // Agrega aquí otros campos de la tabla payment_methods que deseas que sean asignables en masa
    ];

    // Agrega aquí otras relaciones o funciones personalizadas según tus necesidades
}
