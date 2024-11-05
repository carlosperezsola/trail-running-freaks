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
        // Verifica si la tabla 'purchase_products' no existe antes de crearla
        if (!Schema::hasTable('purchase_products')) {
            Schema::create('purchase_products', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('purchase_id'); // Asegúrate de que el purchase_id sea un entero sin signo
                $table->unsignedBigInteger('product_id'); // Asegúrate de que el product_id sea un entero sin signo
                $table->unsignedBigInteger('thirdParty_id'); // Asegúrate de que el thirdParty_id sea un entero sin signo
                $table->string('product_name');
                $table->text('options')->nullable(); // Permite que las opciones sean nulas
                $table->integer('option_total')->nullable(); // Permite que option_total sea nulo
                $table->decimal('unit_price', 15, 2); // Usa decimal para el precio unitario
                $table->integer('qty');

                // Agregar claves foráneas si las tablas correspondientes existen
                $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('cascade');
                $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
                $table->foreign('thirdParty_id')->references('id')->on('third_parties')->onDelete('cascade');

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_products');
    }
};
