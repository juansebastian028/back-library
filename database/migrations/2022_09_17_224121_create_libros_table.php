<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('autor');
            $table->string('anio');
            $table->string('genero');
            $table->integer('paginas');
            $table->string('editorial');
            $table->string('ISSN');
            $table->string('idioma');
            $table->integer('precio');
            $table->integer('cantidad');
            $table->string('estado');
            $table->timestamp('fecha_publicacion')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('libros');
    }
}
