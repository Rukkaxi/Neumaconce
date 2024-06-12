<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagsTableSeeder extends Seeder
{
    
    public function run()
    {
        $tags = [
            '4x4', 'city-car', 'hatchback', 'universal', 'pedal', 
            'filtro', 'luz', 'volante', 'sedan', 'coupe', 'convertible', 
            'electric', 'hybrid', 'turbo', 'manual', 'automatic', 
            'suspension', 'llantas', 'neumaticos', 'escape', 'bateria', 
            'motor', 'aceite', 'refrigerante', 'transmision', 'frenos', 
            'amortiguadores', 'spoiler', 'parachoques', 'faros', 'alarma','sistema de enfriamiento', 'inyección de combustible', 'filtro de aire', 'filtro de aceite', 
            'filtro de cabina', 'sistema de encendido', 'bujías', 'correas', 'cadena de distribución', 
            'embrague', 'diferencial', 'eje', 'transmisión automática', 'transmisión manual', 
            'sistema de dirección', 'dirección asistida', 'sistema de suspensión', 'sistema de escape', 
            'catalizador', 'turboalimentador', 'intercooler', 'radiador', 'ventilador', 'alternador', 
            'arranque', 'sistema eléctrico', 'luces LED', 'sensor de estacionamiento', 'cámara de visión trasera', 
            'sistema de navegación',
            
        ];

        foreach ($tags as $tag) {
            Tag::create(['name' => $tag]);
        }
    }
}
