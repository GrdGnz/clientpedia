<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientBookerTable extends Migration
{
    public function up()
    {
        Schema::create('client_booker', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
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
        Schema::dropIfExists('client_booker');
    }
}
