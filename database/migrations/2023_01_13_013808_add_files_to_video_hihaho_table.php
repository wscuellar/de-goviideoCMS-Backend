<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('video_hihaho', function (Blueprint $table) {
            $table->text('embed_url')->nullable();
            $table->text('iframe_element')->nullable();
            $table->text('player_url')->nullable();
            $table->text('thumbnails_big')->nullable();
            $table->integer('start_time')->nullable()->default(0);
            $table->integer('end_time')->nullable()->default(0);
            $table->integer('duration')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('video_hihaho', function (Blueprint $table) {
            $table->dropColumn('embed_url');
            $table->dropColumn('iframe_element');
            $table->dropColumn('player_url');
            $table->dropColumn('thumbnails_big');
            $table->dropColumn('thumbnails_small');
            $table->dropColumn('start_time');
            $table->dropColumn('end_time');
            $table->dropColumn('duration');
        });
    }
};
