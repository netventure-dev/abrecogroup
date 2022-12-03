<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAgeingRvTable extends Migration {

	public function up()
	{
		Schema::create('ageing_rv', function(Blueprint $table) {
			$table->bigIncrements('id', true);
			$table->timestamps();
			$table->softDeletes();
			$table->string('year', 255);
			$table->bigInteger('variant_id')->unsigned();
			$table->string('rv', 255);
			$table->integer('status')->default('0');
		});
	}

	public function down()
	{
		Schema::drop('ageing_rv');
	}
}