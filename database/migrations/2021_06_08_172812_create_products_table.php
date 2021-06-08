<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->foreignId('category_id')->constrained;
            $table->foreignId('unit_id')->constrained;
            $table->decimal('price',6,2);
            $table->decimal('stock',6,2);
            $table->foreignId('supplier_id')->constrained;
            $table->string('slug');
            $table->string('presentation',30);
            $table->string('brand',50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
