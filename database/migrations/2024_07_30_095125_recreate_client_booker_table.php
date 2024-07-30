<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecreateClientBookerTable extends Migration
{
    public function up()
    {
        // Drop the existing client_booker table if it exists
        Schema::dropIfExists('client_booker');

        // Create the client_booker table with the new schema
        Schema::create('client_booker', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->string('name');
            $table->string('designation')->nullable();
            $table->string('department')->nullable();
            $table->string('contact_landline')->nullable();
            $table->string('contact_mobile')->nullable();
            $table->string('email')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        // Drop the client_booker table
        Schema::dropIfExists('client_booker');
    }
}
