<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAffiliateConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliate_configs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('status');
            $table->longText('contents');
            $table->timestamps();
        });
        
        \App\Models\AffiliateConfig::create([
            'name'     => 'This is title of affiliate program',
            'status'   => 0,
            'contents' => '<p>This is content of affiliate.</p>',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('affiliate_configs');
    }
}
