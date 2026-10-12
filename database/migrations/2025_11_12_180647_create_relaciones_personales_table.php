<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('relaciones_personales', function (Blueprint $table) {
            $table->id('id_relacion');
            $table->unsignedBigInteger('id_tutor'); // adulto/tutor
            $table->unsignedBigInteger('id_nino');  // menor
            $table->unsignedBigInteger('id_parentesco');
            $table->enum('estado_validacion', ['Pendiente', 'Validado', 'Rechazado'])->default('Pendiente');
            $table->timestamp('fecha_registro')->useCurrent();
            $table->timestamp('fecha_validacion')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();

            // Foreign keys (si tu BD las acepta; ajusta nombres si tu PKs difieren)
            $table->foreign('id_tutor')->references('id_persona')->on('personas')->onDelete('cascade');
            $table->foreign('id_nino')->references('id_persona')->on('personas')->onDelete('cascade');
            $table->foreign('id_parentesco')->references('id_parentesco')->on('parentescos')->onDelete('restrict');
            // índices
            $table->index(['id_tutor']);
            $table->index(['id_nino']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('relaciones_personales');
    }
};
