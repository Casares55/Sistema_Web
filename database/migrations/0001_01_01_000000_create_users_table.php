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
        // === Tabla USERS (principal) ===
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // id autoincremental (PK)
            $table->string('nombre', 100);
            $table->string('ap', 100)->nullable();
            $table->string('am', 100)->nullable();
            $table->string('email', 150)->unique();
            $table->string('password');
            $table->unsignedBigInteger('rol_id')->nullable(); // FK → roles.id_rol
            $table->boolean('estado')->default(true);
            $table->timestamp('ultimo_login')->nullable();
            $table->timestamp('fecha_creacion')->useCurrent();
            $table->rememberToken();
            $table->timestamps();

            // Clave foránea con la tabla roles
            $table->foreign('rol_id')
                ->references('id_rol')
                ->on('roles')
                ->onDelete('set null');
        });

        // === Tabla PASSWORD_RESET_TOKENS ===
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email', 150)->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // === Tabla SESSIONS ===
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index(); // Relacionada a users.id
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        // === Inserta roles base si aún no existen ===
        if (DB::table('roles')->count() === 0) {
            DB::table('roles')->insert([
                ['descripcion' => 'admin', 'created_at' => now(), 'updated_at' => now()],
                ['descripcion' => 'docente', 'created_at' => now(), 'updated_at' => now()],
                ['descripcion' => 'tutor', 'created_at' => now(), 'updated_at' => now()],
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
