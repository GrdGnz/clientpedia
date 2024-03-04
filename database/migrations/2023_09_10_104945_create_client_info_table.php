<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientInfoTable extends Migration
{
    public function up()
    {
        Schema::create('client_info', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->integer('client_type_id')->default(1); // Set the default value to 1 (Corporate)
            $table->string('global_customer_number')->unique()->nullable();
            $table->dateTime('contract_start_date')->nullable();
            $table->dateTime('contract_end_date')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('client_info');
    }
}
