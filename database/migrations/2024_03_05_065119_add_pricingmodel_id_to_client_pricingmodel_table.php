<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPricingmodelIdToClientPricingmodelTable extends Migration
{
    public function up()
    {
        Schema::table('client_pricingmodel', function (Blueprint $table) {
            $table->unsignedBigInteger('pricingmodel_id')->after('pricingmodel_type_id'); // New field
        });
    }

    public function down()
    {
        Schema::table('client_pricingmodel', function (Blueprint $table) {
            $table->dropColumn('pricingmodel_id');
        });
    }
}
