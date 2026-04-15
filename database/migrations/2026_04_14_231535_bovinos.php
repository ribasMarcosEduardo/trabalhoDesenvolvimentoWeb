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
        Schema::create('bovinos', function (Blueprint $table) {
        $table->id(); 
        $table->string('raca'); 
        $table->decimal('peso', 8, 2); 
        $table->integer('idade')->nullable();
        $table->string('imagem')->nullable(); 
        $table->timestamps(); 
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bovinos');
    }
};
