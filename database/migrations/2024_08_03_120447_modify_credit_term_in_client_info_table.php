<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCreditTermInClientInfoTable extends Migration
{
    public function up()
    {
        Schema::table('client_info', function (Blueprint $table) {
            // Change 'credit_term' column from integer to string
            $table->string('credit_term')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('client_info', function (Blueprint $table) {
            // Change 'credit_term' column back to integer
            $table->integer('credit_term')->nullable()->change();
        });
    }
}
