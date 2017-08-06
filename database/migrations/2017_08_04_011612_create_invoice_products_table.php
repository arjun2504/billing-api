<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_products', function(Blueprint $table) {
            $table->bigIncrements('id')->index();
            $table->string('product_code');
            $table->string('product_name');
            $table->float('meter', 20, 3)->nullable();
            $table->float('quantity',20,2);
            $table->float('rate',20,2);
            //$table->float('sale');
            $table->float('amount_gst',20,2);
            $table->float('amount',20,2);
            $table->float('cgst',8,2);
            $table->float('sgst',8,2);
            $table->bigInteger('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_products');
    }
}
