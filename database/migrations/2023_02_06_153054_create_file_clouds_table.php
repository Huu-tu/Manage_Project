<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileCloudsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    protected $table = 'index_article';
    public function up()
    {
        Schema::create('fileClouds', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('url');
            $table->string('size');
            $table->string('type');
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
        Schema::dropIfExists('file_clouds');
    }
}
