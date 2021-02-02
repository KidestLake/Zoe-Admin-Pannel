<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendingArtistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pending_artists', function (Blueprint $table) {

            $table->id();

            $table->string('first_name', 25);
            $table->string('last_name', 25);
            $table->string('email')->unique()->nullable();
            $table->string('phone', 20);
            $table->string('password');

            $table->string('location')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('id_image');

            $table->string('artist_name');
            $table->string('bank_name');
            $table->string('account_number');

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
        Schema::dropIfExists('pending_artists');
    }
}
