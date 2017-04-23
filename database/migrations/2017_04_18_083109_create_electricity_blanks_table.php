<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElectricityBlanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('electricity_blanks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('house_id')->unsigned()->index();
            $table->foreign('house_id')->references('id')->on('houses')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->float('tariff_single');
            $table->float('tariff_day');
            $table->float('tariff_night');
            $table->float('consumption');
            $table->float('sum_day');
            $table->float('sum_night');
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
        Schema::drop('electricity_blanks');
    }
}
