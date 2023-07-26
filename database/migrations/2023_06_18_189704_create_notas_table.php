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
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('curso_disciplina_id')->constrained('curso_disciplina')->cascadeOnDelete();
            $table->foreignId('aluno_id')->constrained('alunos')->cascadeOnDelete();
            $table->integer('nota_primeira')->unsigned()->nullable();
            $table->integer('nota_segunda')->unsigned()->nullable();
            $table->integer('nota_terceira')->unsigned()->nullable();
            $table->integer('nota_final')->unsigned()->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};
