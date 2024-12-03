<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'precio', 'descripcion', 'imagen', 'categoria_id'];

    public function imagenes()
    {
        return $this->hasMany(ImagenProducto::class, 'producto_id');
    }


    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
