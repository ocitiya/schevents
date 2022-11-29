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
        Schema::table('municipalities', function (Blueprint $table) {
            $table->foreignUuid("country_id")->after("id");
            $table->foreignUuid("province_id")->nullable()->after("country_id");
            DB::statement("ALTER TABLE `municipalities` CHANGE `county_id` `county_id` CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('municipalities', 'country_id')) {
            Schema::table('municipalities', function (Blueprint $table) {
                $table->dropColumn('country_id');
            });
        }

        if (Schema::hasColumn('municipalities', 'province_id')) {
            Schema::table('municipalities', function (Blueprint $table) {
                $table->dropColumn('province_id');
            });
        }
    }
};
