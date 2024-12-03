<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagenesProductosTable extends Migration
{
    public function up()
    {
        Schema::create('imagenes_productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
            $table->string('ruta');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('imagenes_productos');
    }
}
