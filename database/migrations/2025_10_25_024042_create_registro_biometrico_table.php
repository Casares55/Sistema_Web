<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('registro_biometrico', function (Blueprint $table) {
            $table->id('id_registro');
            $table->unsignedBigInteger('id_usuario')->nullable();
            $table->unsignedBigInteger('id_persona')->nullable();
            $table->string('etiqueta_registro', 150)->nullable(); // ej: "padre-entrada"
            $table->timestamp('fecha_registro')->useCurrent();
            $table->boolean('activo')->default(true);
            $table->timestamps();

            $table->foreign('id_usuario')->references('id')->on('users')->nullOnDelete();
            $table->foreign('id_persona')->references('id_persona')->on('personas')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registro_biometrico');
    }
};
