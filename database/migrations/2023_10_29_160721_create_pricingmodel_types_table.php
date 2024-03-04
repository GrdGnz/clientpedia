<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricingmodelTypesTable extends Migration
{
    public function up()
    {
        Schema::create('pricingmodel_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->binary('status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pricingmodel_types');
    }
}
