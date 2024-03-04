<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientTravelPolicyTable extends Migration
{
    public function up()
    {
        Schema::create('client_travel_policy', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->integer('category_id');
            $table->string('lla');
            $table->string('service_class');
            $table->string('flight_window');
            $table->string('advance_purchase');
            $table->string('lcc_condition');
            $table->string('seat_selection');
            $table->string('baggage_allowance');
            $table->string('group_booking_policy');
            $table->string('companion_hcp_personaltravel');
            $table->integer('status_id')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('client_travel_policy');
    }
}
