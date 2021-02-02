<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("slug");
            $table->text("description");
            $table->string("cover_image")->nullable();
            $table->unsignedBigInteger("publisher_id")->nullable();
            $table->string("publisher_name")->nullable();
            $table->unsignedBigInteger("church_id")->nullable();
            $table->string("church_name")->nullable();

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
        Schema::dropIfExists('news');
    }
}
