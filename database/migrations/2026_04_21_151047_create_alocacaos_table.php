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
    Schema::create('alocacoes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('bovino_id')->constrained()->onDelete('cascade');
        $table->foreignId('fazenda_id')->constrained()->onDelete('cascade');
        $table->date('data_entrada');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alocacaos');
    }
};
