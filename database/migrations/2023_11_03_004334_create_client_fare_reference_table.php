<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientFareReferenceTable extends Migration
{
    public function up()
    {
        Schema::create('client_fare_reference', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id'); // Define the foreign key column
            $table->string('code');
            $table->string('description');
            $table->text('definition');
            $table->unsignedBigInteger('status_id')->default(1); // Set the default value to 1
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('client_fare_reference');
    }
}
