<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecommerce_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->index()->default(0);
            $table->string('name');
            $table->boolean('display')->default(true);
            $table->tinyInteger('position')->default(1);
            $table->timestamps();
        });

        Schema::create('ecommerce_category_company', function (Blueprint $table) {
            $table->integer('product_id')->unsigned()->index();
            $table->integer('category_id')->unsigned()->index();

            $table->foreign('product_id')
                ->references('id')->on('ecommerce_products')
                ->onDelete('cascade');

            $table->foreign('category_id')
                ->references('id')->on('ecommerce_categories')
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
        Schema::dropIfExists('ecommerce_category_company');
        Schema::dropIfExists('ecommerce_categories');
    }
}
