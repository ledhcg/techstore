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
            $table->integer('user_id');
            $table->string('client_name');
            $table->string('client_email');
            $table->string('client_phone');
            $table->string('client_address');
            $table->enum('order_status', ['CREATED', 'RECEIVED', 'DELIVERING', 'DELIVERED'])->default('CREATED');
            $table->string('order_note');
            $table->float('order_total');
            $table->float('order_discount');
            $table->string('order_payment');
            $table->enum('order_payment_status', ['CREATED', 'CANCELED', 'SUCCEEDED'])->default('CREATED');
            $table->float('order_ship');
            $table->string('order_tracking');
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
