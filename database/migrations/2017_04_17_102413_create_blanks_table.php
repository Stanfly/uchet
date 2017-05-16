<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blanks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('house_id')->unsigned()->index();
            $table->foreign('house_id')->references('id')->on('houses')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->float('tariff');
            $table->float('volume');
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
        Schema::drop('blanks');
    }
}
