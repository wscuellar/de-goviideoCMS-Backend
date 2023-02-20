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
        Schema::create('video_synthesia', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->string('store_id')->nullable();
            $table->unsignedInteger('brand_id')->nullable();
            $table->unsignedInteger('location_id')->nullable();

            $table->string('video_uuid')->nullable();

            $table->text('title')->nullable();
            $table->text('description')->nullable();


            $table->string('visibility')->nullable(); //public private
            $table->string('callback_email')->nullable(); //email

            $table->string('avatar')->nullable(); //id avatar
            $table->text('script_text')->nullable();
            $table->string('voice')->nullable(); //id voice
            $table->string('horizontal_aling')->nullable(); //left, center
            $table->string('scale')->nullable();
            $table->string('style')->nullable(); //rectangular, circular
            $table->string('background')->nullable(); //
            $table->string('corporate')->nullable(); //
            $table->string('settings_label')->nullable(); //
            $table->string('settings_url')->nullable(); //


            $table->string('status_synthesia')->nullable(); // complete, in_progress
            $table->text('url')->nullable(); //url de descarga
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('video_synthesia');
    }
};
