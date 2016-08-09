<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('promotions', function (Blueprint $table){
			$table->increments('id');
			$table->string('name');
			$table->decimal('amount')->default(0);
			$table->integer('status');
			$table->longText('contents');
			$table->timestamps();
		});

		\App\Models\Promotion::create([
			'name'     => 'Gift $2 each order with total $10 or more.',
			'amount'   => '10',
			'status'   => 0,
			'contents' => '<p>Gift $2 each order with total $10 or more.</p>',
		]);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('promotions');
	}
}
