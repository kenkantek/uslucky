<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code');
            $table->text('description');
            $table->timestamp('begin_at');
            $table->timestamp('end_at');
            $table->string('value');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('discountables', function (Blueprint $table) {
            $table->integer('discount_id')->index()->unsigned();
            $table->morphs('discountable');

            $table->foreign('discount_id')
                ->references('id')
                ->on('discounts')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('discountables');
        Schema::dropIfExists('discounts');
    }
}
