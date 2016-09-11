<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactPartnersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contact_partners', function (Blueprint $table){
			$table->increments('id');
			$table->string('name');
			$table->string('address');
			$table->string('zipcode');
			$table->string('phone');
			$table->string('contact_person');
			$table->string('cell_phone');
			$table->text('message');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contact_partners');
	}
}
