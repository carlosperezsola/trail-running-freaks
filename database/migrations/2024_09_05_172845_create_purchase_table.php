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
        // Verifica si la tabla 'purchases' no existe antes de crearla
        if (!Schema::hasTable('purchases')) {
            Schema::create('purchases', function (Blueprint $table) {
                $table->id();
                $table->string('invoice_id')->unique(); // Hacer el invoice_id único, si es apropiado
                $table->unsignedBigInteger('user_id'); // Asegúrate de que el user_id sea un entero sin signo

                // Aquí puedes agregar la clave foránea si tienes una tabla 'users'
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

                $table->double('sub_total', 15, 2); // Definir precisión para el subtotal
                $table->double('amount', 15, 2); // Definir precisión para el total
                $table->string('currency_name');
                $table->string('currency_icon');
                $table->integer('product_qty');
                $table->string('payment_method');
                $table->integer('payment_status');
                $table->text('purchase_address');
                $table->text('shipping_method');
                $table->string('purchase_status');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
