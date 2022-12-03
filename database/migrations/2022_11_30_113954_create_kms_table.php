<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKmsTable extends Migration {

	public function up()
	{
		Schema::create('kms', function(Blueprint $table) {
			$table->bigIncrements('id', true);
			$table->timestamps();
			$table->softDeletes();
			$table->string('name', 255);
			$table->bigInteger('difficulty_id')->unsigned();
			$table->integer('status')->default('0');
		});
	}

	public function down()
	{
		Schema::drop('kms');
	}
}