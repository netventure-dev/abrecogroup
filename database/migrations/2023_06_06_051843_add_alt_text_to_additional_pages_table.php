<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAltTextToAdditionalPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('additional_pages', function (Blueprint $table) {
            $table->string('alt_text')->after('image1')->nullable();
            $table->string('logo_alt_text')->after('image2')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('additional_pages', function (Blueprint $table) {
            //
        });
    }
}
