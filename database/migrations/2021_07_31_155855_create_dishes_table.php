<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description');
            $table->unsignedMediumInteger('servTime');
            $table->unsignedInteger('recipeYield')->default(1);
            $table->text('recipeCuisine')->nullable();
            $table->decimal('price',6,2);
            $table->decimal('cost',6,2);
            $table->decimal('costPriceRatio',6,2);
            $table->decimal('mc',6,2);
            $table->decimal('profitableness',6,2);
            $table->decimal('deliveryCharges',6,2)->nullable();
            $table->boolean('inStock');
            $table->unsignedSmallInteger('rating');
            $table->string('slug');
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
        Schema::dropIfExists('dishes');
    }
}
