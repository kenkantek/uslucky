<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOfferProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ecommerce_products', function (Blueprint $table) {
            $table->decimal('sale_price',19,4)->nullable();
            $table->string('offer')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ecommerce_products', function (Blueprint $table) {
            $table->dropColumn('sale_price');
            $table->dropColumn('offer');
        });
    }
}
