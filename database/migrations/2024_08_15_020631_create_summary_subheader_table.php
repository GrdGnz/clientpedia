<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSummarySubheaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('summary_subheader', function (Blueprint $table) {
            $table->id(); // This creates an auto-incrementing primary key field named 'id'
            $table->unsignedBigInteger('header_id'); // This creates an integer field named 'header_id'
            $table->string('title'); // This creates a string field named 'title'
            $table->string('service_type'); // This creates a string field named 'service_type'
            $table->timestamps(); // This creates 'created_at' and 'updated_at' fields

            // You can also add a foreign key constraint if needed:
            // $table->foreign('header_id')->references('id')->on('summary_header')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('summary_subheader');
    }
}
