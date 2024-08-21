<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSnapCodeToClientPreferredCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_preferred_cars', function (Blueprint $table) {
            $table->string('snap_code')->nullable()->after('car_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_preferred_cars', function (Blueprint $table) {
            $table->dropColumn('snap_code');
        });
    }
}
