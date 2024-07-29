<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientApproverTable extends Migration
{
    public function up()
    {
        Schema::create('client_approver', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->string('name');
            $table->string('designation')->nullable();
            $table->string('department')->nullable();
            $table->string('contact_landline')->nullable();
            $table->string('contact_mobile')->nullable();
            $table->string('email')->nullable();
            $table->integer('approver_level'); // New field added after 'email'
            $table->unsignedBigInteger('status_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('client_approver');
    }
}
