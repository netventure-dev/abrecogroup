<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVariantsTable extends Migration {

	public function up()
	{
		Schema::create('variants', function(Blueprint $table) {
			$table->bigIncrements('id', true);
			$table->timestamps();
			$table->softDeletes();
			$table->string('name', 255);
			$table->bigInteger('brand_id')->unsigned();
			$table->bigInteger('sub_model_id')->unsigned();
			$table->string('on_road_price', 255);
			$table->string('offer', 255)->nullable();
			$table->bigInteger('fuel_id')->unsigned();
			$table->integer('status')->default('0');
		});
	}

	public function down()
	{
		Schema::drop('variants');
	}
}