<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('reservation_id')->unsigned();
            $table->bigInteger('suite_id')->unsigned();
            $table->string('rate_type');
            $table->integer('adults');
            $table->integer('children');
            $table->decimal('subtotal');

            $table->foreign('reservation_id')->references('id')->on('reservations');
            $table->foreign('suite_id')->references('id')->on('suites');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservation_details');
    }
}
