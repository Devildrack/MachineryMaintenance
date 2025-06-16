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
        Schema::table('maquinaria_equipos', function (Blueprint $table) {
            $table->dropColumn('frente_trabajo');

            $table->unsignedBigInteger('frente_trabajo_id');
            $table->foreign('frente_trabajo_id')->references('id')->on('frente_trabajos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('maquinaria_equipos', function (Blueprint $table) {
            $table->addColumn('string', 'frente_trabajo')->nullable();
            $table->dropForeign(['frente_trabajo_id']);
            $table->dropColumn('frente_trabajo_id');
        });
    }
};
