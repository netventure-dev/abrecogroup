<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOwnersTable extends Migration {

	public function up()
	{
		Schema::create('owners', function(Blueprint $table) {
			$table->bigIncrements('id', true);
			$table->timestamps();
			$table->softDeletes();
			$table->string('no_of_owners', 255);
			$table->bigInteger('difficulty_id')->unsigned();
			$table->integer('status')->default('0');
		});
	}

	public function down()
	{
		Schema::drop('owners');
	}
}