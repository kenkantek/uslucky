<?php

use Illuminate\Database\Migrations\Migration;

class CreateStripeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('payments', function ($table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->string('stripe_id')->nullable();
            $table->string('card_name')->nullable();
            $table->string('card_brand')->default('Visa');
            $table->string('card_last_four')->nullable();
            $table->tinyInteger('month_exp')->nullable();
            $table->integer('year_exp')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
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
        Schema::dropIfExists('payments');
    }
}
