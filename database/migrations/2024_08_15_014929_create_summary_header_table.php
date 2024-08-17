<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSummaryHeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('summary_header', function (Blueprint $table) {
            $table->id(); // This creates an auto-incrementing primary key field named 'id'
            $table->string('title'); // This creates a string field named 'title'
            $table->string('service_type'); // This creates a string field named 'service_type'
            $table->timestamps(); // This creates 'created_at' and 'updated_at' fields
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('summary_header');
    }
}
