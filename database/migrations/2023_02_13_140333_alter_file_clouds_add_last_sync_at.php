<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFileCloudsAddLastSyncAt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fileClouds', function (Blueprint $table) {
            $table->timestamp('last_sync_at')->nullable();
            $table->index('last_sync_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fileClouds', function (Blueprint $table) {
            $table->dropColumn('last_sync_at');
        });
    }
}
