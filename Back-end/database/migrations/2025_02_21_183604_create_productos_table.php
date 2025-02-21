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
        Schema::create('productos', function (Blueprint $table) {
            $table->id('ProductoID'); // Auto-incremental Primary
            $table->string('NumeroControl', 30)->nullable();
            $table->string('NumeroSerie', 30)->nullable();
            $table->string('Descripcion', 300);
            $table->string('Modelo', 50)->nullable();
            $table->string('Marca', 50)->nullable();
            $table->string('Categoria', 30)->nullable();
            $table->string('Factura', 30)->nullable();
            $table->integer('Cantidad')->default(0);
            $table->decimal('Valor', 10, 2)->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
