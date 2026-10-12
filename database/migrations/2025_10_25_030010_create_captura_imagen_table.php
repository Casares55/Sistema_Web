<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('captura_imagen', function (Blueprint $table) {
            $table->id('id_imagen');
            $table->unsignedBigInteger('id_dispositivo')->nullable();
            $table->unsignedBigInteger('id_registro')->nullable();
            $table->string('ruta_imagen', 400); // path en storage
            $table->string('hash_imagen', 128)->nullable();
            $table->timestamp('fecha_captura')->useCurrent();
            $table->timestamps();

            $table->foreign('id_registro')->references('id_registro')->on('registro_biometrico')->nullOnDelete();
            $table->foreign('id_dispositivo')->references('id_dispositivo')->on('dispositivos')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('captura_imagen');
    }
};
