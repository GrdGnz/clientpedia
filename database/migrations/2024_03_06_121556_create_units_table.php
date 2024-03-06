<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUnitsTable extends Migration
{
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Insert default values
        DB::table('units')->insert([
            ['name' => 'per pax'],
            ['name' => 'per transaction'],
            ['name' => 'per person'],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('units');
    }
}
