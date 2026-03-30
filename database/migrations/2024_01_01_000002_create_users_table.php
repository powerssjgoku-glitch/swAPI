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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->string('apa')->nullable();
            $table->string('ama')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('curp')->nullable();
            $table->text('direccion')->nullable();
            $table->string('telefonos')->nullable();
            $table->foreignId('perfil_id')->nullable()->constrained('roles')->onDelete('set null');
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
