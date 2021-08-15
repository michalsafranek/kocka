<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuMealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_meals', function (Blueprint $table) {
            $table->id();
            $table->integer('menu', false, false);
            $table->tinyInteger('day', false, false);
            $table->enum('type', ['soup', 'main', 'desert', 'text']);
            $table->string('ammount', 15)->nullable();
            $table->string('name');
            $table->double('price', 6,2);
            $table->string('alergens', 50);
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
        Schema::dropIfExists('menu_meals');
    }
}
