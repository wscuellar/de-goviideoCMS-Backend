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
        Schema::create('videos', function (Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('store_id')->nullable();
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->unsignedBigInteger('video_id');
            $table->string('video_uuid');
            $table->string('video_container_id')->nullable();
            $table->text('display_name')->nullable();
            $table->text('description')->nullable();
            $table->text('embed_url')->nullable();
            $table->text('iframe_element')->nullable();
            $table->text('player_url')->nullable();
            $table->integer('status')->default(1);
            $table->text('thumbnails_big')->nullable();
            $table->text('thumbnails_small')->nullable();
            $table->unsignedBigInteger('location_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->text('observation')->nullable();
            $table->json('info')->nullable();
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
        Schema::dropIfExists('videos');
    }
};
