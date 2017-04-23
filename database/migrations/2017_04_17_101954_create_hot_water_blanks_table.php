<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotWaterBlanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hot_water_blanks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('house_id')->unsigned()->index();
            $table->foreign('house_id')->references('id')->on('houses')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->float('norm');
            $table->float('total_volume_of_MKD');
            $table->float('tariff_with_NDS');
            $table->float('volume_of_services');
            $table->float('charged');
            $table->float('recalculation');
            $table->float('total_charged');
            $table->date('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('hot_water_blanks');
    }
}
