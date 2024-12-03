<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    public function up()
{
    Schema::create('productos', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->string('categoria');
        $table->decimal('precio', 10, 2);
        $table->text('descripcion');
        $table->string('imagen')->nullable(); // Imagen principal
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
