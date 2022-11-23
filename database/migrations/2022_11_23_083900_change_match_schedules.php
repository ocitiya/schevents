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
            $table->foreignId("lp_type_id")->nullable()->after("description");
            $table->foreignId("channel_id")->nullable()->after("lp_type_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('match_schedule', 'lp_type_id')) {
            Schema::table('match_schedule', function (Blueprint $table) {
                $table->dropColumn('lp_type_id');
            });
        }

        if (Schema::hasColumn('match_schedule', 'channel_id')) {
            Schema::table('match_schedule', function (Blueprint $table) {
                $table->dropColumn('channel_id');
            });
        }
    }
};
