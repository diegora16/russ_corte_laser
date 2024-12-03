<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Carrito;

class CarritosSeeder extends Seeder
{
    public function run()
    {
        Carrito::create(['producto_id' => 1, 'cantidad' => 2]);
        Carrito::create(['producto_id' => 2, 'cantidad' => 1]);
    }
}
