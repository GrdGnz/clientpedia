<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientSummaryOfFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_summary_of_fees', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->integer('client_id'); // Foreign key reference to the client
            $table->string('category');
            $table->string('sub_category')->nullable();
            $table->string('service_id');
            $table->string('measure')->nullable();
            $table->string('currency')->nullable();
            $table->string('standard_office_hours')->nullable();
            $table->string('after_office_hours')->nullable();
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_summary_of_fees');
    }
}
