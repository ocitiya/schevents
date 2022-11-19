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
        if (Schema::hasColumn('events', 'link')) {
            Schema::table('events', function (Blueprint $table) {
                $table->dropColumn('link');
            });
        }

        Schema::table('events', function (Blueprint $table) {
            $table->foreignId("campaign_id")->nullable()->after("name");
            $table->foreignId("banner_id")->nullable()->after("campaign_id");
            $table->foreignId("channel_id")->nullable()->after("banner_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('events', 'campaign_id')) {
            Schema::table('events', function (Blueprint $table) {
                $table->dropColumn('campaign_id');
            });
        }

        if (Schema::hasColumn('events', 'banner_id')) {
            Schema::table('events', function (Blueprint $table) {
                $table->dropColumn('banner_id');
            });
        }

        if (Schema::hasColumn('events', 'channel_id')) {
            Schema::table('events', function (Blueprint $table) {
                $table->dropColumn('channel_id');
            });
        }
    }
};
