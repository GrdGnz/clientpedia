<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientContactsTable extends Migration
{
    public function up()
    {
        Schema::create('client_contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->string('name');
            $table->string('designation');
            $table->string('department');
            $table->string('contact_landline')->nullable();
            $table->string('contact_mobile')->nullable();
            $table->string('email')->nullable();
            $table->date('birthday')->nullable();
            $table->text('remarks')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->timestamps();

            // If you have a foreign key constraint for the 'status_id' column, you can add it here.
            // Example: $table->foreign('status_id')->references('id')->on('statuses')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('client_contacts');
    }
}

