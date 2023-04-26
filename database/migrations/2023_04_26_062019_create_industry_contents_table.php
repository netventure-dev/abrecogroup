<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndustryContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('industry_contents', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('industries_id');
            $table->longText('title');
            $table->longText('description');
            $table->string('order');
            $table->string('image')->nullable();
            $table->string('button_title')->nullable();
            $table->string('button_link')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('industry_contents');
    }
}
