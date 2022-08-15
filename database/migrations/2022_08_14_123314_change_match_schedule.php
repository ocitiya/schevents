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
            if (Schema::hasColumn('match_schedule', 'county_id')) {
                $table->dropColumn('county_id');
            }

            if (Schema::hasColumn('match_schedule', 'county2_id')) {
                $table->dropColumn('county2_id');
            }
            
            $table->uuid('federation_id')->after("id");
            $table->enum('match_system', ["home", "away", "neutral"])->after("school1_id");
            $table->enum('match_system2', ["home", "away", "neutral"])->after("school2_id");
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
            $table->uuid('county_id');
            $table->uuid('county2_id')->after('county_id')->nullable();
            $table->dropColumn('federation_id');
            $table->dropColumn('match_system');
            $table->dropColumn('match_system2');
        });
    }
};
