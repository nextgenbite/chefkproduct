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
            $table->string('name');
            $table->string('code');
            $table->string('phone');
            $table->string('address');
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->text('notes')->nullable();
            $table->float('total',8,2);
            $table->float('coupon',8,2)->default(0);
            $table->string('shipping_cost')->default(0);
            $table->string('order_date');
            $table->string('order_month');
            $table->string('order_year');
            $table->string('payment_mehood')->default('cash_on_delivary');
            $table->string('payment_status')->default('pending');
            $table->string('status')->default('pending');
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
