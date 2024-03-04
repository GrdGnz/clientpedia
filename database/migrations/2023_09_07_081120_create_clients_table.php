<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->integer('accountmanager_user_id');
            $table->string('name')->nullable();
            $table->string('code')->unique()->nullable(); // Added 'code' field with unique constraint
            $table->integer('status_id')->default(1);
            $table->timestamps(); // Adds created_at and updated_at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
