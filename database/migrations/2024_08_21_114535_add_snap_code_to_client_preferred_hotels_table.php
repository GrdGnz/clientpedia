<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSnapCodeToClientPreferredHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_preferred_hotels', function (Blueprint $table) {
            $table->string('snap_code')->nullable()->after('hotel_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_preferred_hotels', function (Blueprint $table) {
            $table->dropColumn('snap_code');
        });
    }
}
