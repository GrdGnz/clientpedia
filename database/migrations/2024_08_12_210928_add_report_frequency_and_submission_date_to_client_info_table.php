<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReportFrequencyAndSubmissionDateToClientInfoTable extends Migration
{
    public function up()
    {
        Schema::table('client_info', function (Blueprint $table) {
            // Add 'report_frequency' and 'submission_date' columns
            $table->string('report_frequency')->nullable();
            $table->string('submission_date')->nullable();
        });
    }

    public function down()
    {
        Schema::table('client_info', function (Blueprint $table) {
            // Drop 'report_frequency' and 'submission_date' columns if rollback is needed
            $table->dropColumn('report_frequency');
            $table->dropColumn('submission_date');
        });
    }
}
