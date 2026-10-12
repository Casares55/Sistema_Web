<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('embeddings', function (Blueprint $table) {
            $table->id('id_embedding');
            $table->unsignedBigInteger('id_imagen');
            $table->longText('vector_embedding'); // json o base64 del vector
            $table->timestamp('fecha_creacion')->useCurrent();
            $table->timestamps();

            $table->foreign('id_imagen')->references('id_imagen')->on('captura_imagen')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('embeddings');
    }
};
