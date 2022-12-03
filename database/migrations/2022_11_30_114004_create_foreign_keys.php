<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('brands', function(Blueprint $table) {
			$table->foreign('difficulty_id')->references('id')->on('sale_difficulties')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('sub_models', function(Blueprint $table) {
			$table->foreign('brand_id')->references('id')->on('brands')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('sub_models', function(Blueprint $table) {
			$table->foreign('difficulty_id')->references('id')->on('sale_difficulties')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('variants', function(Blueprint $table) {
			$table->foreign('brand_id')->references('id')->on('brands')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('variants', function(Blueprint $table) {
			$table->foreign('sub_model_id')->references('id')->on('sub_models')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('fuel_types', function(Blueprint $table) {
			$table->foreign('difficulty_id')->references('id')->on('sale_difficulties')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('kms', function(Blueprint $table) {
			$table->foreign('difficulty_id')->references('id')->on('sale_difficulties')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('owners', function(Blueprint $table) {
			$table->foreign('difficulty_id')->references('id')->on('sale_difficulties')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('ageing_rv', function(Blueprint $table) {
			$table->foreign('variant_id')->references('id')->on('variants')
						->onDelete('cascade')
						->onUpdate('no action');
		});
	}

	public function down()
	{
		Schema::table('brands', function(Blueprint $table) {
			$table->dropForeign('brands_difficulty_id_foreign');
		});
		Schema::table('sub_models', function(Blueprint $table) {
			$table->dropForeign('sub_models_brand_id_foreign');
		});
		Schema::table('sub_models', function(Blueprint $table) {
			$table->dropForeign('sub_models_difficulty_id_foreign');
		});
		Schema::table('variants', function(Blueprint $table) {
			$table->dropForeign('variants_brand_id_foreign');
		});
		Schema::table('variants', function(Blueprint $table) {
			$table->dropForeign('variants_sub_model_id_foreign');
		});
		Schema::table('fuel_types', function(Blueprint $table) {
			$table->dropForeign('fuel_types_difficulty_id_foreign');
		});
		Schema::table('kms', function(Blueprint $table) {
			$table->dropForeign('kms_difficulty_id_foreign');
		});
		Schema::table('owners', function(Blueprint $table) {
			$table->dropForeign('owners_difficulty_id_foreign');
		});
		Schema::table('ageing_rv', function(Blueprint $table) {
			$table->dropForeign('ageing_rv_variant_id_foreign');
		});
	}
}