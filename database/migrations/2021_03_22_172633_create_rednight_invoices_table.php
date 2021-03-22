<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRednightInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rednight_invoices', function (Blueprint $table) {
            $table->id();
            $table->timestamp('invoice_date')->useCurrent();
            $table->text('invoice_number');
            $table->string('account_name', 100);
            $table->string('bill_to', 255);
            $table->string('ship_to', 255);
            $table->float('total_products_and_other_charges');
            $table->float('invoice_sub_total');
            $table->float('sales_tax');
            $table->float('invoice_total');
            $table->float('payments');
            $table->float('credits');
            $table->float('balance_due');
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
        Schema::dropIfExists('rednight_invoices');
    }
}
