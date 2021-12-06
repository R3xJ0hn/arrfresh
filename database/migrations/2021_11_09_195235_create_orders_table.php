<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('payment_method')->nullable();
            $table->string('payment_type');
            $table->string('transaction_id')->nullable();
            $table->string('balance_transaction')->nullable();

            $table->unsignedBigInteger('shipping_id');
            $table->integer('product_units')->nullable();
            $table->float('sub_total',8,2);  
            $table->float('amount',8,2);  
            $table->string('coupon_used')->nullable();
            $table->string('invoice_no');
            $table->string('place_date');
            $table->string('paid_date');

            $table->string('pick_bin')->nullable();
            $table->string('picked_date')->nullable();

            $table->string('shipped_date')->nullable();
            $table->string('tracking_number')->nullable();

            $table->string('delivered_date')->nullable();
            $table->string('cancel_date')->nullable();
            $table->string('return_date')->nullable();
            $table->string('return_reason')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('orders');
    }
}
