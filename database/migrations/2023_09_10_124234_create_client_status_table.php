<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientStatusTable extends Migration
{
    public function up()
    {
        Schema::create('client_status', function (Blueprint $table) {
            $table->id();
            $table->string('status_name')->default('Active');
            $table->timestamps();
        });

        // Insert default values
        DB::table('client_status')->insert([
            ['status_name' => 'Active'],
            ['status_name' => 'Inactive'],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('client_status');
    }
}
