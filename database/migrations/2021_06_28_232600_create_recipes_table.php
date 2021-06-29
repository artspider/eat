<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipeCategory_id')->constrained;
            $table->string('name');
            $table->longText('description');
            $table->unsignedMediumInteger('prepTime');
            $table->unsignedMediumInteger('cookTime');
            $table->unsignedMediumInteger('totalTime');
            $table->text('recipeYield');
            $table->enum('suitableForDiet',['DiabeticDiet','GlutenFreeDiet','HalalDiet','HinduDiet','KosherDiet','LowCalorieDiet','LowFatDiet','LowLactoseDiet','LowSaltDiet','VeganDiet','VegetarianDiet'])->nullable();
            $table->text('recipeCuisine')->nullable();
            $table->decimal('price',6,2);
            $table->decimal('cost',6,2);
            $table->decimal('costPriceRatio',6,2);
            $table->decimal('mc',6,2);
            $table->decimal('profitableness',6,2);
            $table->decimal('deliveryCharges',6,2)->nullable();
            $table->boolean('inStock');
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
        Schema::dropIfExists('recipes');
    }
}
