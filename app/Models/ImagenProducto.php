<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenProducto extends Model
{
    use HasFactory;

    protected $table = 'imagenes_productos'; // Especificar el nombre de la tabla
    protected $fillable = ['producto_id', 'ruta'];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
