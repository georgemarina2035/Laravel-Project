<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpirtsCounselingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expirts_counselings', function (Blueprint $table) {
            $table->id();
            $table->integer('expirt_id')->unsigned();
            $table->integer('counseling_id')->unsigned();
            $table->foreign('expirt_id')->references('id')->on('expirts')
            ->onDelete('cascade');
            $table->foreign('counseling_id')->references('id')->on('counselings')
            ->onDelete('cascade');
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
        Schema::dropIfExists('expirts_counselings');
    }
}
