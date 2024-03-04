<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientBookingProcessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_booking_process', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('route_id');
            $table->unsignedBigInteger('category_id');
            $table->integer('order_number');
            $table->string('description');
            $table->timestamps();

            $table->foreign('client_id')
                  ->references('id')
                  ->on('clients');

            // Add other indexes or constraints if needed

        });
    }

    public function down()
    {
        Schema::dropIfExists('client_booking_process');
    }
}
