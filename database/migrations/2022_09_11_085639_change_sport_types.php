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
        Schema::table('sport_types', function (Blueprint $table) {
            DB::statement("ALTER TABLE `sport_types` CHANGE `name` `name` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;");
            $table->foreignUuid('sport_id')->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE `sport_types` CHANGE `name` `name` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;");
        if (Schema::hasColumn('sport_types', 'sport_id')) {
            Schema::table('sport_types', function (Blueprint $table) {
                $table->dropColumn('sport_id');
            });
        }
    }
};
