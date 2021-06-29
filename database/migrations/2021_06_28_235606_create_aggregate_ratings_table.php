<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAggregateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aggregate_ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')->constrained;
            $table->smallInteger('ratingValue');
            $table->smallInteger('ratingCount');
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
        Schema::dropIfExists('aggregate_ratings');
    }
}
