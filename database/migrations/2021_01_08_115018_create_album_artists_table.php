<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumArtistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('album_artists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('album_id');
            $table->string('album_name');
            $table->unsignedBigInteger('artist_id')->nullable();
            $table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade');
            $table->foreign('artist_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('artist_name');
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
        Schema::dropIfExists('album_artists');
    }
}
