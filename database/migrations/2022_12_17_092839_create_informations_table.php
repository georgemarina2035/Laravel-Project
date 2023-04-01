<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->string('experience');
            $table->string('mobile');
            $table->string('email')->unique();
            $table->string('address');
            $table->integer('expirt_id');
            $table->timestamps();
            // $table->foreign('expirt_id')->references('id')->on('expirts')
            // ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('informations');
    }
}

