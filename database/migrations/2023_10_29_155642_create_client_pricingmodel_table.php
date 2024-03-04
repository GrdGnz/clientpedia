<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientPricingmodelTable extends Migration
{
    public function up()
    {
        Schema::create('client_pricingmodel', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('route_id');
            $table->unsignedBigInteger('pricingmodel_type_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('client_pricingmodel');
    }
}
