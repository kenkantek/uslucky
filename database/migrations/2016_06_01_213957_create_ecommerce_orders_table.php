<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEcommerceOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecommerce_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->decimal('total', 19, 4)->unsigned();

            $table->text('description');

            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

        });

        Schema::create('ecommerce_order_product', function (Blueprint $table) {
            $table->integer('order_id')->unsigned()->index();
            $table->integer('product_id')->unsigned()->index();

            $table->integer('count');
            $table->decimal('price', 19, 4)->unsigned();

            $table->foreign('order_id')
                ->references('id')
                ->on('ecommerce_orders')
                ->onDelete('cascade');

            $table->foreign('product_id')
                ->references('id')
                ->on('ecommerce_products')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ecommerce_order_product');
        Schema::dropIfExists('ecommerce_orders');
    }
}
