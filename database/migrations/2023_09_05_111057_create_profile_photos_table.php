<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilePhotosTable extends Migration
{
    public function up()
    {
        Schema::create('profile_photos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key to users table
            $table->string('photo_path');
            $table->string('thumbnail_path');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('profile_photos');
    }
}
