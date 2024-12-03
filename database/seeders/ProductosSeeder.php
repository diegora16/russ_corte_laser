<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;
use App\Models\Categoria;

class ProductosSeeder extends Seeder
{
    public function run()
    {
        $recordatorios = Categoria::firstOrCreate(['nombre' => 'Recordatorios']);
        $relojes = Categoria::firstOrCreate(['nombre' => 'Relojes']);
        $lamparas = Categoria::firstOrCreate(['nombre' => 'Lámparas']);

        Producto::create([
            'nombre' => 'Recordatorio - Matrimonio',
            'precio' => 49.90,
            'categoria_id' => $recordatorios->id, // Relacionado a la categoría "Recordatorios"
            'descripcion' => 'Hermosos recordatorios personalizados ideales para matrimonios y eventos especiales.',
        ]);

        Producto::create([
            'nombre' => 'Relojes - Fútbol',
            'precio' => 99.90,
            'categoria_id' => $relojes->id, // Relacionado a la categoría "Relojes"
            'descripcion' => 'Relojes temáticos inspirados en equipos de fútbol. Perfectos para fanáticos.',
        ]);

        Producto::create([
            'nombre' => 'Lámparas - Autos',
            'precio' => 79.90,
            'categoria_id' => $lamparas->id, // Relacionado a la categoría "Lámparas"
            'descripcion' => 'Lámparas decorativas con diseños de autos y motos para decorar cualquier espacio.',
        ]);
    }
}
