<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('levels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('game_id')->unsigned()->index();
            $table->tinyInteger('level')->default(0)->index();
            $table->string('label');
            $table->decimal('award', 19, 4)->default(0); // jackpot cũng sẽ có giá là 0
            $table->timestamps();

            $table->foreign('game_id')
            ->references('id')
            ->on('games')
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
        Schema::dropIfExists('levels');
    }
}
