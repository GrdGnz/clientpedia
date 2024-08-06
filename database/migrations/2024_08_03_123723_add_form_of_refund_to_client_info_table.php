<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFormOfRefundToClientInfoTable extends Migration
{
    public function up()
    {
        Schema::table('client_info', function (Blueprint $table) {
            // Add 'form_of_refund' column
            $table->string('form_of_refund')->nullable();
        });
    }

    public function down()
    {
        Schema::table('client_info', function (Blueprint $table) {
            // Drop 'form_of_refund' column if rollback is needed
            $table->dropColumn('form_of_refund');
        });
    }
}
