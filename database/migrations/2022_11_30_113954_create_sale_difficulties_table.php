<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSaleDifficultiesTable extends Migration {

	public function up()
	{
		Schema::create('sale_difficulties', function(Blueprint $table) {
			$table->bigIncrements('id', true);
			$table->timestamps();
			$table->softDeletes();
			$table->string('name', 199);
			$table->string('point', 199);
		});
	}

	public function down()
	{
		Schema::drop('sale_difficulties');
	}
}