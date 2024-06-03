<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Commune;
use App\Models\Region;

class CommunesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define communes for each region
        
        // Arica y Parinacota
        $this->seedCommunes('Arica y Parinacota', [
            'Arica', 'Camarones', 'Putre', 'General Lagos'
        ]);

        // Tarapacá
        $this->seedCommunes('Tarapacá', [
            'Iquique', 'Alto Hospicio', 'Pozo Almonte', 'Camiña', 'Colchane', 'Huara', 'Pica'
        ]);

        // Antofagasta
        $this->seedCommunes('Antofagasta', [
            'Antofagasta', 'Mejillones', 'Sierra Gorda', 'Taltal', 'Calama', 'Ollagüe', 'San Pedro de Atacama', 'Tocopilla', 'María Elena'
        ]);

        // Atacama
        $this->seedCommunes('Atacama', [
            'Copiapó', 'Caldera', 'Tierra Amarilla', 'Chañaral', 'Diego de Almagro', 'Vallenar', 'Alto del Carmen', 'Freirina', 'Huasco'
        ]);

        // Coquimbo
        $this->seedCommunes('Coquimbo', [
            'La Serena', 'Coquimbo', 'Andacollo', 'La Higuera', 'Paihuano', 'Vicuña', 'Illapel', 'Canela', 'Los Vilos', 'Salamanca', 'Ovalle', 'Combarbalá', 'Monte Patria', 'Punitaqui', 'Río Hurtado'
        ]);

        // Valparaíso
        $this->seedCommunes('Valparaíso', [
            'Valparaíso', 'Casablanca', 'Concón', 'Juan Fernández', 'Puchuncaví', 'Quintero', 'Viña del Mar', 'Isla de Pascua', 'Los Andes', 'Calle Larga', 'Rinconada', 'San Esteban', 'La Ligua', 'Cabildo', 'Papudo', 'Petorca', 'Zapallar', 'Quillota', 'Calera', 'Hijuelas', 'La Cruz', 'Nogales', 'San Antonio', 'Algarrobo', 'Cartagena', 'El Quisco', 'El Tabo', 'Santo Domingo', 'San Felipe', 'Catemu', 'Llaillay', 'Panquehue', 'Putaendo', 'Santa María', 'Quilpué', 'Limache', 'Olmué', 'Villa Alemana'
        ]);

        // Metropolitana de Santiago
        $this->seedCommunes('Metropolitana de Santiago', [
            'Santiago', 'Cerrillos', 'Cerro Navia', 'Conchalí', 'El Bosque', 'Estación Central', 'Huechuraba', 'Independencia', 'La Cisterna', 'La Florida', 'La Granja', 'La Pintana', 'La Reina', 'Las Condes', 'Lo Barnechea', 'Lo Espejo', 'Lo Prado', 'Macul', 'Maipú', 'Ñuñoa', 'Pedro Aguirre Cerda', 'Peñalolén', 'Providencia', 'Pudahuel', 'Quilicura', 'Quinta Normal', 'Recoleta', 'Renca', 'San Joaquín', 'San Miguel', 'San Ramón', 'Vitacura', 'Puente Alto', 'Pirque', 'San José de Maipo', 'Colina', 'Lampa', 'Tiltil', 'San Bernardo', 'Buin', 'Calera de Tango', 'Paine', 'Melipilla', 'Alhué', 'Curacaví', 'María Pinto', 'San Pedro', 'Talagante', 'El Monte', 'Isla de Maipo', 'Padre Hurtado', 'Peñaflor'
        ]);

        // O'Higgins
        $this->seedCommunes('O’Higgins', [
            'Rancagua', 'Codegua', 'Coinco', 'Coltauco', 'Doñihue', 'Graneros', 'Las Cabras', 'Machalí', 'Malloa', 'Mostazal', 'Olivar', 'Peumo', 'Pichidegua', 'Quinta de Tilcoco', 'Rengo', 'Requínoa', 'San Vicente', 'Pichilemu', 'La Estrella', 'Litueche', 'Marchihue', 'Navidad', 'Paredones', 'San Fernando', 'Chépica', 'Chimbarongo', 'Lolol', 'Nancagua', 'Palmilla', 'Peralillo', 'Placilla', 'Pumanque', 'Santa Cruz'
        ]);

        // Continue adding communes for each region
        // Remember to include all 346 Chilean communes
    }

    /**
     * Seed communes for a specific region.
     *
     * @param string $regionName
     * @param array $communeNames
     * @return void
     */
    private function seedCommunes($regionName, $communeNames)
    {
        $region = Region::where('name', $regionName)->first();

        foreach ($communeNames as $communeName) {
            $region->commune()->create(['name' => $communeName]);
        }
    }
}
