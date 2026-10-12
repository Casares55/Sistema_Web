<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id('id_persona');
            $table->unsignedBigInteger('id_tipopersona')->nullable();
            $table->string('nombre',150);
            $table->string('apellido_paterno',150)->nullable();
            $table->string('apellido_materno',150)->nullable();
            $table->string('telefono',30)->nullable();
            $table->string('correo',150)->nullable();
            $table->string('direccion')->nullable();
            $table->timestamp('fecha_registro')->useCurrent();
            $table->boolean('estado')->default(true);
            $table->timestamps();

            // FK opcional: tipopersonas
            $table->foreign('id_tipopersona')->references('id_tipopersona')->on('tipo_personas')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
