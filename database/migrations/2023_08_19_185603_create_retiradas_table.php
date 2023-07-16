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
        Schema::create('retiradas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medicamento_id')->constrained('medicamentos')->cascadeOnDelete();
            $table->integer('quantidade_inicial')->unsigned()->default(0);
            $table->integer('quantidade_retirada')->unsigned()->default(0);
            $table->integer('quantidade_stock')->unsigned()->default(0);
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::create('item_retirada', function (Blueprint $table) {
            $table->id();
            $table->foreignId('retirada_id')->constrained('retiradas')->cascadeOnDelete();
            $table->string('codigo')->unique();
            $table->date('data_validade');
            $table->bigInteger('medicamento_id')->nullable();
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
        Schema::dropIfExists('retiradas');
        Schema::dropIfExists('item_retirada');

    }
};
