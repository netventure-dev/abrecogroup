<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_contents', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('service_id');
            $table->longText('title');
            $table->longText('description');
            $table->string('order');
            $table->string('image')->nullable();
            $table->string('image_position')->nullable();
            $table->string('button_title')->nullable();
            $table->string('button_link')->nullable();
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
        Schema::dropIfExists('service_contents');
    }
}
