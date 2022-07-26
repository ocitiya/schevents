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
        Schema::table('match_schedule', function (Blueprint $table) {
            $table->uuid('county2_id')->after('county_id')->nullable();
            $table->integer('score1')->after('county2_id')->nullable();
            $table->integer('score2')->after('score1')->nullable();
            $table->string('youtube_link')->after('score2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('match_schedule', function (Blueprint $table) {
            if (Schema::hasColumn('schools', 'county2_id')) {
                $table->dropColumn('county2_id');
            };

            if (Schema::hasColumn('schools', 'score1')) {
                $table->dropColumn('score1');
            };

            if (Schema::hasColumn('schools', 'score2')) {
                $table->dropColumn('score2');
            };

            if (Schema::hasColumn('schools', 'youtube_link')) {
                $table->dropColumn('youtube_link');
            };
        });
    }
};
