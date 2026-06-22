<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vacantes', function (Blueprint $table) {
            $table->increments('id_vacante');
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->string('modalidad')->nullable();
            $table->string('ubicacion')->nullable();
            $table->timestamp('fecha_publicacion')->useCurrent();
            $table->string('estado')->default('activa');
            $table->unsignedInteger('id_usuario');
            $table->foreign('id_usuario')->references('id_usuario')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacantes');
    }
};
