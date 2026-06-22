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
        Schema::create('postulaciones', function (Blueprint $table) {
            $table->increments('id_postulacion');
            $table->unsignedInteger('id_vacante');
            $table->unsignedInteger('id_usuario');
            $table->text('hoja_vida')->nullable();
            $table->timestamp('fecha_postulacion')->useCurrent();
            $table->string('estado')->default('pendiente');

            $table->foreign('id_vacante')->references('id_vacante')->on('vacantes')->onDelete('cascade');
            $table->foreign('id_usuario')->references('id_usuario')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postulaciones');
    }
};
