<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ImagenProducto;

class ImagenesSeeder extends Seeder
{
    public function run()
    {
        ImagenProducto::create(['producto_id' => 1, 'ruta' => '/img/recordatorios-matrimonio.jpg']);
        ImagenProducto::create(['producto_id' => 1, 'ruta' => '/img/recordatorios-matrimonio2.jpg']);
        ImagenProducto::create(['producto_id' => 1, 'ruta' => '/img/recordatorios-matrimonio3.jpg']);

        ImagenProducto::create(['producto_id' => 2, 'ruta' => '/img/relojes-futbol.jpg']);
        ImagenProducto::create(['producto_id' => 2, 'ruta' => '/img/relojes-futbol2.jpg']);
        ImagenProducto::create(['producto_id' => 2, 'ruta' => '/img/relojes-futbol3.jpg']);

        ImagenProducto::create(['producto_id' => 3, 'ruta' => '/img/lamparas-autos.jpg']);
        ImagenProducto::create(['producto_id' => 3, 'ruta' => '/img/lamparas-autos2.jpg']);
        ImagenProducto::create(['producto_id' => 3, 'ruta' => '/img/lamparas-autos3.jpg']);
    }
}
