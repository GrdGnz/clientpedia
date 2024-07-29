<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsToClientInfoTable extends Migration
{
    public function up()
    {
        Schema::table('client_info', function (Blueprint $table) {
            $table->integer('sla_response_time_int')->nullable()->after('submitted_quotation');
            $table->integer('sla_response_time_dom')->nullable()->after('sla_response_time_int');
            $table->string('billing_currency')->nullable()->after('sla_response_time_dom');
            $table->string('value_added_tax')->nullable()->after('billing_currency');
            $table->string('transaction_fee')->nullable()->after('value_added_tax');
            $table->string('agent_commission')->nullable()->after('transaction_fee');
        });
    }

    public function down()
    {
        Schema::table('client_info', function (Blueprint $table) {
            $table->dropColumn([
                'sla_response_time_int',
                'sla_response_time_dom',
                'billing_currency',
                'value_added_tax',
                'transaction_fee',
                'agent_commission',
            ]);
        });
    }
}
