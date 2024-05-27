<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToMissionVisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mission_visions', function (Blueprint $table) {
            $table->string('values_title')->nullable()->after('vision_image');
            $table->longText('values_content')->nullable();
            $table->string('values_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mission_visions', function (Blueprint $table) {
            //
        });
    }
}
