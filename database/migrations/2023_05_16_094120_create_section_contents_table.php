<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_contents', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('title')->nullable();
            $table->string('section_id');
            $table->string('icon')->nullable();
            $table->string('icon_content')->nullable();
            $table->string('button_title')->nullable();
            $table->string('button_link')->nullable();
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
        Schema::dropIfExists('section_contents');
    }
}
