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
        // Verifica si la tabla 'product_options' no existe antes de crearla
        if (!Schema::hasTable('product_options')) {
            Schema::create('product_options', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('product_id'); // Asegúrate de que el product_id sea un entero sin signo

                // Aquí puedes agregar la clave foránea si tienes una tabla 'products'
                $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

                $table->string('name');
                $table->boolean('status')->default(true); // Establecer un valor predeterminado para el estado
                $table->timestamps();
            });
        }
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_option_items');
    }
};
