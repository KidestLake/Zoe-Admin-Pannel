<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternationalPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('international_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('song_id');
            $table->string('song_title');
            $table->unsignedBigInteger('user_id');
            $table->double('price');
            $table->double('net_price');
            $table->double('service_fee');
            $table->dateTime('purchased_date');
            $table->boolean('is_payed')->default(false);
           // $table->foreign('song_id')->references('id')->on('songs')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
           
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
        Schema::dropIfExists('international_payments');
    }
}
