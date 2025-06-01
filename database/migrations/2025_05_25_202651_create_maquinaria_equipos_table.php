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
        Schema::create('maquinaria_equipos', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->foreignId('tipo_maquinaria_equipo_id')->constrained()->onDelete('restrict'); // FK al tipo
            $table->string('modelo')->nullable();
            $table->string('marca')->nullable();
            $table->string('numero_serie')->nullable();
            $table->string('propietario')->nullable();
            $table->string('frente_trabajo')->nullable();
            $table->date('fecha_alta')->nullable();
            $table->string('tipo_combustible')->nullable();
            $table->date('fecha_ultimo_servicio')->nullable();
            $table->integer('horometro_ultimo_servicio')->nullable();
            $table->enum('condicion', ['En Operación', 'Mantenimiento'])->default('En Operación');
            $table->enum('estatus', ['Activo', 'Inactivo'])->default('Activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maquinaria_equipos');
    }
};
