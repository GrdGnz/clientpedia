<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecreateClientFareReferenceTable extends Migration
{
    public function up()
    {
        // Drop the original table if it exists
        Schema::dropIfExists('client_fare_reference');

        Schema::create('client_fare_reference', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('client_id'); // Foreign key column
            $table->string('published_fares'); // Reference column
            $table->string('private_fares'); // Reference column
            $table->string('corporate_fares'); // Reference column
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('client_fare_reference');
    }
}
