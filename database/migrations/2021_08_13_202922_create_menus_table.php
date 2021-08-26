<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->integer('restaurant', false, true);
            $table->smallInteger('year', false, true);
            $table->tinyInteger('week', false, true);
            $table->string('caption');
            $table->text('text');
            $table->timestamps();
            $table->primary(['restaurant', 'year', 'week']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
