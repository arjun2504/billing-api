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
            $table->increments('id')->index();
            $table->string('product_code');
            $table->string('product_name');
            $table->float('meter', 8, 3);
            $table->float('quantity');
            $table->float('rate');
            $table->float('sale');
            $table->float('amount_gst');
            $table->float('amount');
            $table->integer('invoice_id')->length(10)->references('id')->on('invoices')->onDelete('cascade');
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
