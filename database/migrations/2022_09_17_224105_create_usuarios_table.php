<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rol_id')->nullable();
            $table->foreign('rol_id')->references('id')->on('roles')->onDelete('set null');
            $table->string('cedula');
            $table->string('nombre');
            $table->string('apellidos');
            $table->date('fecha_nacimiento');
            $table->string('genero');         
            $table->string('email')->unique();
            $table->string('nombre_usuario')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('foto')->nullable();
            $table->boolean('noticias');
            $table->rememberToken();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
