<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;

class BranchesTableSeeder extends Seeder
{
    public function run()
    {
        Branch::create([
            'name' => 'Sucursal Principal - Freire #82',
            'address' => 'Freire #82',
        ]);
    }
}
