<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->foreignUuid("sport_id")->after("federation_id");
            DB::statement("ALTER TABLE `match_schedule` CHANGE `federation_id` `federation_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;");
            DB::statement("ALTER TABLE `match_schedule` CHANGE `sport_type_id` `sport_type_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('match_schedule', 'sport_id')) {
            Schema::table('match_schedule', function (Blueprint $table) {
                $table->dropColumn('sport_id');
            });
        }
        DB::statement("ALTER TABLE `match_schedule` CHANGE `federation_id` `federation_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '';");
        DB::statement("ALTER TABLE `match_schedule` CHANGE `sport_type_id` `sport_type_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '';");
    }
};
