<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('statusable');
            $table->enum('status', [
                'pendding', 'canceled', 'failed', 'succeeded',
                'processing', 'done',
                'actived', 'disabled',
                'waiting', 'wait for purchase', 'purchased', 'won', 'fail',
            ])->default('pendding');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statuses');
    }
}
