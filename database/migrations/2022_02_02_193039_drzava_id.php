<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DrzavaId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kompanija', function (Blueprint $table) {
            $table->unsignedBigInteger('drzava_id');
            $table->foreign('drzava_id')->references('id')->on('drzava');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kompanija', function (Blueprint $table) {
            $table->dropForeign('drzava_id');
            $table->removeColumn('drzava_id');
        });
    }
}
