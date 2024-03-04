<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('status_id')->default(1);
            $table->timestamps();
        });

        // Add default data
        $categories = [
            ['name' => 'air'],
            ['name' => 'hotel'],
            ['name' => 'car'],
            ['name' => 'car transfer'],
            ['name' => 'documentation'],
        ];

        DB::table('categories')->insert($categories);
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
