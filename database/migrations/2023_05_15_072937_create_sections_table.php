<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('title');
            $table->string('slug');
            $table->longText('subtitle')->nullable();
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('background_image')->nullable();
            $table->longText('content')->nullable();
            $table->string('link')->nullable();
            $table->boolean('status')->default(1);
            $table->string('order')->nullable();
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
        Schema::dropIfExists('sections');
    }
}
