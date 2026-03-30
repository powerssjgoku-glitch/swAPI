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
        // project_advisors pivot table
        Schema::create('project_advisors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['project_id', 'user_id']);
        });

        // project_asignatura pivot table
        Schema::create('project_asignatura', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->foreignId('asignatura_id')->constrained('asignaturas')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['project_id', 'asignatura_id']);
        });

        // deliverable_tags pivot table
        Schema::create('deliverable_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('deliverable_id')->constrained('deliverables')->onDelete('cascade');
            $table->foreignId('document_tag_id')->constrained('document_tags')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['deliverable_id', 'document_tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliverable_tags');
        Schema::dropIfExists('project_asignatura');
        Schema::dropIfExists('project_advisors');
    }
};
