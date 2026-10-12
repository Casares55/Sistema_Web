<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id('id_rol'); // Clave primaria personalizada
            $table->string('descripcion', 100)->unique();
            $table->timestamps();
        });

        // Inserta roles básicos iniciales
        DB::table('roles')->insert([
            ['descripcion' => 'admin', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => 'docente', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => 'tutor', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
