<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('song_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('song_id');
            $table->string('detail_name');
            $table->text('detail_value');
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
        Schema::dropIfExists('song_details');
    }
}
