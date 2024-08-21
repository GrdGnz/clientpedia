<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeDescriptionNullableInClientTravelSecurityTable extends Migration
{
    public function up()
    {
        Schema::table('client_travel_security', function (Blueprint $table) {
            $table->text('description')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('client_travel_security', function (Blueprint $table) {
            $table->text('description')->nullable(false)->change();
        });
    }
}
