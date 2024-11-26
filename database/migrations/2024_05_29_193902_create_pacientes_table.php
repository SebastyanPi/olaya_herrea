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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();

            $table->string('nombres',100);
            $table->string('apellidos',100);
            $table->string('ci',100)->unique();
            $table->date('fecha_nacimiento');
            $table->string('genero',10);
            $table->string('celular',20);
            $table->string('correo',100)->unique();
            $table->string('direccion',255);
            $table->string('grupo_sanguineo',255);
            $table->string('alergias',255);
            $table->string('contacto_emergencia',255);
            $table->string('observaciones',255)->nullable();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('tipoafiliacion_id')->nullable();
            $table->foreign('tipoafiliacion_id')->references('id')->on('tipoafiliacion')->onDelete('restrict');

            $table->unsignedBigInteger('tipopaciente_id')->nullable();
            $table->foreign('tipopaciente_id')->references('id')->on('tipopaciente')->onDelete('restrict');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
