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
        Schema::create('examenes_asignados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estudiante_id')->constrained('estudiantes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('examen_id')->constrained('examenes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('docente_id')->constrained('docentes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('curso_id')->constrained('cursos')->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('nota', 5, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examenes_asignados');
    }
};
