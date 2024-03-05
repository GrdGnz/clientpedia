<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyClientFeesTable extends Migration
{
    public function up()
    {
        Schema::table('client_fees', function (Blueprint $table) {
            $table->string('currency')->nullable()->before('amount');
            $table->string('percentage')->nullable()->after('amount');
        });
    }

    public function down()
    {
        Schema::table('client_fees', function (Blueprint $table) {
            $table->dropColumn('currency');
            $table->dropColumn('percentage');
        });
    }
}
