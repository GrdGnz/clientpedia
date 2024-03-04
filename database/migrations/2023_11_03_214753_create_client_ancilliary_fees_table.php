<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientAncilliaryFeesTable extends Migration
{
    public function up()
    {
        Schema::create('client_ancilliary_fees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->string('description');
            $table->string('currency_code', 3);
            $table->decimal('amount', 10, 2);
            $table->integer('status_id')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('client_ancilliary_fees');
    }
}
