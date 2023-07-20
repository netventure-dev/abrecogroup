<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemoIndustriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demo_industries', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->longText('title');
            $table->string('slug');
            $table->longText('subtitle')->nullable();
            $table->longText('content')->nullable();
            $table->longText('description');
            $table->string('order');
            $table->string('image')->nullable();
            $table->string('mobile_image')->nullable();
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
        Schema::dropIfExists('demo_industries');
    }
}
