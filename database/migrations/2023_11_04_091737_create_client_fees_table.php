<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientFeesTable extends Migration
{
    public function up()
    {
        Schema::create('client_fees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->integer('category_id');
            $table->integer('route_id');
            $table->string('description');
            $table->integer('source_id');
            $table->decimal('amount', 10, 2); // Assuming you want 10 digits and 2 decimal places for the "amount" field
            $table->integer('status_id')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('client_fees');
    }
}
