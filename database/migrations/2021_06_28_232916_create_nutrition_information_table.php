<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNutritionInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nutrition_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')->constrained()->onDelete('cascade');
            $table->mediumInteger('calories');
            $table->mediumInteger('carbohydrateContent')->nullable();
            $table->mediumInteger('cholesterolContent')->nullable();
            $table->mediumInteger('fatContent')->nullable();
            $table->mediumInteger('fiberContent')->nullable();
            $table->mediumInteger('proteinContent')->nullable();
            $table->mediumInteger('saturatedFatContent')->nullable();
            $table->mediumInteger('servingSize')->nullable();
            $table->mediumInteger('sodiumContent')->nullable();
            $table->mediumInteger('sugarContent')->nullable();
            $table->mediumInteger('transFatContent')->nullable();
            $table->mediumInteger('unsaturatedFatContent')->nullable();
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
        Schema::dropIfExists('nutrition_information');
    }
}
