<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Asset;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid')->nullable();
            $table->enum('type',[
                        Asset::IMAGE,
                        Asset::VOICE,
                        Asset::VIDEO,
                        Asset::AVATAR,
                        Asset::BACKGROUND,
                        Asset::UPLOADS,
                        Asset::OTHER
            ]);
            $table->boolean('status')->default(true);
            $table->string('name');
            $table->string('attribute')->nullable();
            $table->string('icon')->nullable();
            $table->string('url')->nullable();
            $table->text('observations')->nullable();
            $table->string('api')->nullable();
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
        Schema::dropIfExists('asset');
    }
};
