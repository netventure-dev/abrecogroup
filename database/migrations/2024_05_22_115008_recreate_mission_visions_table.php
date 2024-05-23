<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecreateMissionVisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('mission_visions');
        
        // Create the new table
        Schema::create('mission_visions', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('mission_title')->nullable();
            $table->string('vision_title')->nullable();
            $table->longText('mission_content')->nullable();
            $table->longText('vision_content')->nullable();
            $table->string('mission_image')->nullable();
            $table->string('vision_image')->nullable();
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mission_visions');
    }
}
