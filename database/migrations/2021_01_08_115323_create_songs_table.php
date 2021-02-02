<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('artist_id');
            $table->string('artist_name');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('album_id')->nullable();
            $table->string('album_name')->nullable();
            // $table->jsonb('details')->nullable();
            // $table->jsonb('instrumentalist')->nullable();
            $table->integer('track_number')->nullable();
            $table->string('language')->nullable();
            $table->date('released_date');
            $table->string('path');
           // $table->foreign('album_id')->references('id')->on('albums')->onDelete('set null');
           // $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('artist_id')->references('id')->on('users')->onDelete('cascade');
           
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
        Schema::dropIfExists('songs');
    }
}
