<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriasSeeder extends Seeder
{
    public function run()
    {
        $categorias = [
            'Recordatorios',
            'Relojes',
            'Lámparas',
            'Portafotos',
            'Trofeos',
            'Catálogo Navidad',
        ];

        foreach ($categorias as $categoria) {
            Categoria::firstOrCreate(['nombre' => $categoria]);
        }
    }
}
