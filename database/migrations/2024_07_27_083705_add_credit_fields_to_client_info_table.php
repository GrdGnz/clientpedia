<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreditFieldsToClientInfoTable extends Migration
{
    public function up()
    {
        Schema::table('client_info', function (Blueprint $table) {
            $table->integer('credit_term')->nullable(); // Adds 'credit_term' column
            $table->integer('credit_limit_usd')->nullable(); // Adds 'credit_limit_usd' column
            $table->integer('credit_limit_php')->nullable(); // Adds 'credit_limit_php' column
            $table->integer('submitted_quotation')->nullable(); // Adds 'submitted_quotation' column
        });
    }

    public function down()
    {
        Schema::table('client_info', function (Blueprint $table) {
            $table->dropColumn(['credit_term', 'credit_limit_usd', 'credit_limit_php', 'submitted_quotation']); // Drops the columns if rollback is needed
        });
    }
}
