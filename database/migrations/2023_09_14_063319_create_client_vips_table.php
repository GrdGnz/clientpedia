<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientVipsTable extends Migration
{
    public function up()
    {
        Schema::create('client_vips', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->string('name');
            $table->string('designation');
            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();
            $table->date('birthday')->nullable();
            $table->text('remarks')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->timestamps();
        });

        // Set a default value for 'client_id'
        DB::table('client_vips')->update(['client_id' => 0]);
    }

    public function down()
    {
        Schema::dropIfExists('client_vips');
    }
}
