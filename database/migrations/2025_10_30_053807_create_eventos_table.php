<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id('id_evento');
            $table->unsignedBigInteger('id_persona');
            $table->unsignedBigInteger('id_dispositivo');
            $table->unsignedBigInteger('id_embedding');
            $table->unsignedBigInteger('id_tipoevento');
            $table->timestamp('fecha_evento')->useCurrent();
            $table->decimal('confianza', 5, 2)->nullable();
            $table->string('resultado', 100)->nullable();

            $table->foreign('id_persona')->references('id_persona')->on('personas')->onDelete('cascade');
            $table->foreign('id_dispositivo')->references('id_dispositivo')->on('dispositivos')->onDelete('cascade');
            $table->foreign('id_embedding')->references('id_embedding')->on('embeddings')->onDelete('cascade');
            $table->foreign('id_tipoevento')->references('id_tipoevento')->on('tipo_eventos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
