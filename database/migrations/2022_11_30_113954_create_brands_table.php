<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBrandsTable extends Migration {

	public function up()
	{
		Schema::create('brands', function(Blueprint $table) {
			$table->bigIncrements('id', true);
			$table->timestamps();
			$table->softDeletes();
			$table->string('name', 199);
			$table->bigInteger('difficulty_id')->unsigned();
			$table->integer('status')->default('0');
		});
	}

	public function down()
	{
		Schema::drop('brands');
	}
}