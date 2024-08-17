<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSummaryServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('summary_services', function (Blueprint $table) {
            $table->id(); // Primary key, auto-incrementing
            $table->unsignedBigInteger('client_id'); // Integer field for client ID
            $table->unsignedBigInteger('header_id')->nullable(); // Integer field for subheader ID
            $table->unsignedBigInteger('subheader_id')->nullable(); // Integer field for subheader ID
            $table->string('service_name'); // String field for service name
            $table->string('measure'); // String field for measure
            $table->string('currency'); // String field for currency
            $table->string('office_hours'); // String field for office hours
            $table->string('after_office_hours'); // String field for after office hours
            $table->timestamps(); // Timestamps for created_at and updated_at

            // You can also add foreign key constraints if needed:
            // $table->foreign('subheader_id')->references('id')->on('summary_subheader')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('summary_services');
    }
}
