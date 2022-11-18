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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId("campaign_id");
            $table->foreignId("banner_id");
            $table->foreignId("channel_id");
            $table->string("long_link");
            $table->string("short_link");
            $table->timestamp('created_at')->nullable();
            $table->foreignUuid('created_by');
            $table->timestamp('updated_at')->nullable();
            $table->foreignUuid('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
    }
};
