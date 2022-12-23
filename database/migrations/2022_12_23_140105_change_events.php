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
        Schema::table('events', function (Blueprint $table) {
            $table->string("start_time")->nullable()->after("start_date");
            $table->string("end_time")->nullable()->after("end_date");
            $table->foreignId("lp_type_id")->nullable()->after("channel_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        if (Schema::hasColumn('events', 'start_time')) {
            Schema::table('events', function (Blueprint $table) {
                $table->dropColumn('start_time');
            });
        }

        if (Schema::hasColumn('events', 'end_time')) {
            Schema::table('events', function (Blueprint $table) {
                $table->dropColumn('end_time');
            });
        }

        if (Schema::hasColumn('events', 'lp_type_id')) {
            Schema::table('events', function (Blueprint $table) {
                $table->dropColumn('lp_type_id');
            });
        }
    }
};
