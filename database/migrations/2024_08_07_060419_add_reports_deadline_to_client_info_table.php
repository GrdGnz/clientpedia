<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReportsDeadlineToClientInfoTable extends Migration
{
    public function up()
    {
        Schema::table('client_info', function (Blueprint $table) {
            // Add 'reports_deadline' column
            $table->string('reports_deadline')->nullable();
        });
    }

    public function down()
    {
        Schema::table('client_info', function (Blueprint $table) {
            // Drop 'reports_deadline' column if rollback is needed
            $table->dropColumn('reports_deadline');
        });
    }
}
