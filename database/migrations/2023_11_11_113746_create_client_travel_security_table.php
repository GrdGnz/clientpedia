<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientTravelSecurityTable extends Migration
{
    public function up()
    {
        Schema::create('client_travel_security', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->text('description');
            $table->integer('status_id')->default(1);
            $table->timestamps(); // Adds 'created_at' and 'updated_at' columns
        });
    }

    public function down()
    {
        Schema::dropIfExists('client_travel_security');
    }
}
