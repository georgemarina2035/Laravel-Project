<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dates', function (Blueprint $table) {
            $table->id();
            $table->string('day');
            $table->integer('from');
            $table->integer('to');
            $table->integer('availabletime_id');
            // $table->foreign('availabletime_id')->references('id')->on('availabletimes')
            // ->onDelete('cascade');
            $table->integer('user_id');
            // $table->foreign('user_id')->references('id')->on('users')
            // ->onDelete('cascade');
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
        Schema::dropIfExists('dates');
    }
}
