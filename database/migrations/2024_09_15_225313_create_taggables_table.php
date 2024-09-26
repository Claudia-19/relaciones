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
        Schema::create('taggables', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            // Columna para la relación con la tabla 'tags'
            $table->unsignedBigInteger('tag_id');
            
            // Columnas para la relación polimórfica
            $table->unsignedBigInteger('taggable_id'); // Relación con otras tablas
            $table->string('taggable_type'); // Modelo relacionado (nombre del modelo)
            
            $table->timestamps();
            
            // Definimos la clave foránea
            $table->foreign('tag_id')->references('id')->on('tags')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            
            // Índices para optimizar la relación polimórfica
            $table->index(['taggable_id', 'taggable_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taggables');
    }
};

