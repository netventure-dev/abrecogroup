<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFuelTypesTable extends Migration {

	public function up()
	{
		Schema::create('fuel_types', function(Blueprint $table) {
			$table->bigIncrements('id', true);
			$table->timestamps();
			$table->softDeletes();
			$table->string('name', 255);
			$table->integer('status')->default('0');
			$table->bigInteger('difficulty_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('fuel_types');
	}
}