<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('game_id')->unsigned()->index();
            $table->integer('nj_id')->unsigned()->unique();
            $table->string('numbers')->index();
            $table->tinyInteger('ball')->index();
            $table->boolean('multiplier')->default(0);
            $table->decimal('annuity', 19, 4);
            $table->timestamp('draw_at');
            $table->boolean('apply_module')->default(false);
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
        Schema::dropIfExists('results');
    }
}
