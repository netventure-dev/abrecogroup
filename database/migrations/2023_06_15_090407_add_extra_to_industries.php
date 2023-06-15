<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraToIndustries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('industries', function (Blueprint $table) {
            $table->longText('subtitle')->nullable()->after('name');
            $table->string('image')->nullable()->after('subtitle');
            $table->string('icon')->nullable()->after('image');
            $table->longText('content')->nullable()->after('icon');
            $table->string('button_title')->nullable()->after('content');
            $table->string('link')->nullable()->after('button_title');
            $table->string('order')->nullable()->after('link');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('industries', function (Blueprint $table) {
            //
        });
    }
}
