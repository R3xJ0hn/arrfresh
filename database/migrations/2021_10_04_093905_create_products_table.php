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

            $table->string('brand_id');
            $table->integer('category_id');
            $table->integer('subcategory_id');

            $table->string('product_name');
            $table->string('product_slug');

            $table->integer('product_available_stock');
            $table->integer('product_total_stock');

            $table->string('product_sku');
            $table->string('product_tags');
            $table->string('product_size');
            $table->string('product_colors')->nullable();

            $table->float('product_selling_price');
            $table->float('product_discount_price')->nullable();
            $table->integer('product_purchased_cnt')->default(0);

            $table->string('product_location');
            $table->string('product_expiry_date')->nullable();

            $table->text('product_short_description')->nullable();
            $table->text('product_long_description')->nullable();

            $table->integer('product_status_new')->nullable();
            $table->integer('product_status_hotdeals')->nullable();
            $table->integer('product_status_featured')->nullable();
            $table->integer('product_status_specialdeals')->nullable();

            $table->string('product_thumbnail');
            $table->string('product_status')->default(0);
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
