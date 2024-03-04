<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientHotelCorporateCodesTable extends Migration
{
    public function up()
    {
        Schema::create('client_hotel_corporate_codes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('hotel_id');
            $table->unsignedBigInteger('route_id');
            $table->integer('status_id')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('client_hotel_corporate_codes');
    }
}
