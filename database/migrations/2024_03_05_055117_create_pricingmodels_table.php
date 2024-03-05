<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePricingmodelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pricingmodels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Inserting predefined values
        DB::table('pricingmodels')->insert([
            ['name' => 'Classic / Traditional'],
            ['name' => 'OBT'],
            ['name' => 'Combination of Classic & OBT'],
            ['name' => 'Management Fee only'],
            ['name' => 'Combination Management Fee and Classic'],
            ['name' => 'Exclusive / Customized (non-standard)'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pricingmodels');
    }
}
