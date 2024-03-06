<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyClientFeesTable extends Migration
{
    public function up()
    {
        Schema::table('client_fees', function (Blueprint $table) {
            $table->string('currency')->nullable()->default('PHP')->before('amount');
            $table->string('percentage')->nullable()->default(0)->after('amount');
            $table->integer('vat')->nullable()->default(0)->after('percentage');
            $table->integer('unit_id')->nullable()->default(1)->after('vat');
            $table->integer('route_type_id')->nullable()->default(1)->after('unit_id');
        });
    }

    public function down()
    {
        Schema::table('client_fees', function (Blueprint $table) {
            $table->dropColumn('currency');
            $table->dropColumn('percentage');
            $table->dropColumn('vat');
            $table->dropColumn('unit_id');
            $table->dropColumn('route_type_id');
        });
    }
}
