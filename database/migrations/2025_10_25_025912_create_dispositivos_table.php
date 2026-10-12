<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dispositivos', function (Blueprint $table) {
            $table->id('id_dispositivo'); // PK
            $table->string('codigo_interno', 100);
            $table->string('descripcion', 255);

            // FK hacia ubicaciones
            $table->unsignedBigInteger('id_ubicacion');
            $table->foreign('id_ubicacion')
                ->references('id_ubicacion')
                ->on('ubicaciones')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->string('direccion_ip', 45)->nullable();
            $table->unsignedBigInteger('id_tipodispositivo');
            $table->foreign('id_tipodispositivo')
                ->references('id_tipodispositivo')
                ->on('tipo_dispositivos')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->string('estatus', 50)->default('activo');
            $table->timestamp('fecha_creacion')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dispositivos');
    }
};
