<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('room_id')->unsigned();
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->enum('state', ['active', 'canceled']);
            $table->date('arrival');
            $table->date('departure');
            $table->integer('num_of_guests');
            $table->bigInteger('breakfast_id')->nullable()->unsigned();
            $table->foreign('breakfast_id')->references('id')->on('breakfasts')->onDelete('cascade');
            $table->bigInteger('extra_service_id')->nullable()->unsigned();
            $table->foreign('extra_service_id')->references('id')->on('extra_services')->onDelete('cascade');
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
        Schema::dropIfExists('reservations');
    }
}
