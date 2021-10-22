<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name_vi');
            $table->string('product_name_ru');
            $table->text('product_description_vi');
            $table->text('product_description_ru');
            $table->string('product_image');
            $table->string('product_unit_vi');
            $table->string('product_unit_ru');
            // Price show to store
            $table->float('product_price_last');
            // Price old when last price < fix price, When sale, fix price > last price, if fix price = 0 => not sale
            $table->float('product_price_fix');
            // Price if client buy > quantity-to-discount
            $table->float('product_price_discount');
            $table->integer('product_quantity_to_discount');
            $table->integer('category_id');
            $table->enum('product_status', ['ACTIVE', 'INACTIVE'])->default('ACTIVE');
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
        Schema::dropIfExists('products');
    }
}
