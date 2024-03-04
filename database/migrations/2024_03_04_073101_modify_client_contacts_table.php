<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyClientContactsTable extends Migration
{
    public function up()
    {
        Schema::table('client_contacts', function (Blueprint $table) {
            $table->string('designation')->nullable()->change();
            $table->string('department')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('client_contacts', function (Blueprint $table) {
            $table->string('designation')->nullable(false)->change();
            $table->string('department')->nullable(false)->change();
        });
    }
}
