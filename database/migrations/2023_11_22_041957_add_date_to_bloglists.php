<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateToBloglists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bloglists', function (Blueprint $table) {
            $table->date('blog_date')->nullable()->after('status');
            $table->string('author')->nullable()->after('blog_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bloglists', function (Blueprint $table) {
            //
        });
    }
}
