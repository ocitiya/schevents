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
        if (Schema::hasColumn('movie_schedules', 'link')) {
            Schema::table('movie_schedules', function (Blueprint $table) {
                $table->dropColumn('link');
            });
        }

        if (Schema::hasColumn('movie_schedules', 'show_date')) {
            Schema::table('movie_schedules', function (Blueprint $table) {
                $table->dropColumn('show_date');
            });
        }

        Schema::table('movie_schedules', function (Blueprint $table) {
            $table->date("release_date")->nullable()->after("movie_id");
            $table->foreignId("campaign_id")->nullable()->after("release_date");
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
        if (Schema::hasColumn('movie_schedules', 'campaign_id')) {
            Schema::table('movie_schedules', function (Blueprint $table) {
                $table->dropColumn('campaign_id');
            });
        }

        if (Schema::hasColumn('movie_schedules', 'banner_id')) {
            Schema::table('movie_schedules', function (Blueprint $table) {
                $table->dropColumn('banner_id');
            });
        }

        if (Schema::hasColumn('movie_schedules', 'channel_id')) {
            Schema::table('movie_schedules', function (Blueprint $table) {
                $table->dropColumn('channel_id');
            });
        }
    }
};
