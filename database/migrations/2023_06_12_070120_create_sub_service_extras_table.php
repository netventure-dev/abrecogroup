<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubServiceExtrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_service_extras', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('sub_service_content_id');
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
        Schema::dropIfExists('sub_service_extras');
    }
}
