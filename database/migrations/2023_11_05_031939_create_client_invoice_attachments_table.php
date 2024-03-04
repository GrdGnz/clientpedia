<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientInvoiceAttachmentsTable extends Migration
{
    public function up()
    {
        Schema::create('client_invoice_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->string('schedule');
            $table->string('description_path');
            $table->string('email_approval_path');
            $table->string('purchase_order_path');
            $table->text('remarks')->nullable();
            $table->integer('status_id')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('client_invoice_attachments');
    }
}
