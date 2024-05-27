<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContentsToInnerServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inner_services', function (Blueprint $table) {
            $table->string('service_slug')->nullable()->after('subservice');
            $table->string('service_name')->nullable()->after('service_slug');
            $table->string('sub_service_slug')->nullable()->after('service_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inner_services', function (Blueprint $table) {
            //
        });
    }
}
