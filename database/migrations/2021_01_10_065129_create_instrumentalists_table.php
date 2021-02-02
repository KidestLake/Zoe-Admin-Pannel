<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstrumentalistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instrumentalists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('song_id');
            $table->string('instrument',50);
            $table->text('players');
            $table->foreign('song_id')->references('id')->on('songs')->onDelete('cascade');
          
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
        Schema::dropIfExists('instrumentalists');
    }
}
