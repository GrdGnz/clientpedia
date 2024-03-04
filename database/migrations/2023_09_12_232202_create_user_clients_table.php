<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserClientsTable extends Migration
{
    public function up()
    {
        Schema::create('user_clients', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('user_id'); // Foreign key to 'users' table
            $table->unsignedBigInteger('client_id'); // Foreign key to 'clients' table
            $table->timestamps(); // Created at and Updated at timestamps

            // Define foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_clients');
    }
}
