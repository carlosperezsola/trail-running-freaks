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
        // Verifica si la tabla 'trademarks' no existe antes de crearla
        if (!Schema::hasTable('trademarks')) {
            Schema::create('trademarks', function (Blueprint $table) {
                $table->id();
                $table->text('logo');
                $table->string('name');
                $table->string('slug')->unique(); // Considera hacer el slug único
                $table->boolean('is_featured')->default(false); // Establecer un valor predeterminado
                $table->boolean('status')->default(true); // Establecer un valor predeterminado
                $table->timestamps();
            });
        }
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trademarks');
    }
};
