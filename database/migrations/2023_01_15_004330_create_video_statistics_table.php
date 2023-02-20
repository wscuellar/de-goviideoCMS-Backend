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
        Schema::create('video_statistics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('video_hihaho_id');
            $table->foreign('video_hihaho_id')->references('id')->on('video_hihaho')->onDelete('cascade');
            $table->dateTime('created_date')->nullable();
            $table->boolean('finished')->nullable()->default(false);
            $table->boolean('happened')->nullable()->default(false);
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
        Schema::dropIfExists('video_statistics');
    }
};
