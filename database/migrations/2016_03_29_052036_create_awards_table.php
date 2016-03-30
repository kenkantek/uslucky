<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('awards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ticket_id')->unsigned()->index();
            $table->integer('level_id')->unsigned()->index();
            $table->decimal('add_award', 19, 4)->default(0); // Tiền trúng cộng thêm vào, giành cho giải jackpot
            $table->timestamps();

            $table->foreign('ticket_id')
            ->references('id')
            ->on('tickets')
            ->onDelete('cascade');
            $table->foreign('level_id')
            ->references('id')
            ->on('levels')
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
        Schema::dropIfExists('awards');
    }
}
