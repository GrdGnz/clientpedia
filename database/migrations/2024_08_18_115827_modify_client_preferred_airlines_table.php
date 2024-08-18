<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyClientPreferredAirlinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_preferred_airlines', function (Blueprint $table) {
            // Modify the 'route_id' column to be nullable
            $table->integer('route_id')->nullable()->change();

            // Add the new nullable columns
            $table->string('snap_code')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('contact_email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_preferred_airlines', function (Blueprint $table) {
            // Revert the 'route_id' column to be non-nullable
            $table->integer('route_id')->nullable(false)->change();

            // Drop the added nullable columns
            $table->dropColumn('snap_code');
            $table->dropColumn('contact_person');
            $table->dropColumn('contact_number');
            $table->dropColumn('contact_email');
        });
    }
}
