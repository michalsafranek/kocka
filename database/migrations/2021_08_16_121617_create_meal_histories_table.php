<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meal_histories', function (Blueprint $table) {
            $table->tinyInteger('restaurantId', false, false);
            $table->enum('type', ['soup', 'main', 'desert', 'text']);
            $table->string('alergens', 50);
            $table->string('name');
            $table->double('price', 6,2);
            $table->string('ammount', 15);
            $table->primary(['restaurantId', 'type', 'name']);
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
        Schema::dropIfExists('meal_histories');
    }
}
