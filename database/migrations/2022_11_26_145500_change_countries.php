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
        if (Schema::hasColumn('countries', 'dial_code')) {
            Schema::table('countries', function (Blueprint $table) {
                $table->dropColumn('dial_code');
                $table->softDeletes();
            });
        }

        Schema::table('countries', function (Blueprint $table) {
            DB::statement("ALTER TABLE `countries` CHANGE `alpha2_code` `alpha3_code` VARCHAR(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;");
            $table->text('image')->nullable()->after('alpha3_code');
            $table->boolean('has_state')->default(false)->after('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('countries', 'has_state')) {
            Schema::table('countries', function (Blueprint $table) {
                $table->dropColumn('has_state');
            });
        }

        if (Schema::hasColumn('countries', 'image')) {
            Schema::table('countries', function (Blueprint $table) {
                $table->dropColumn('image');
            });
        }

        if (Schema::hasColumn('countries', 'deleted_at')) {
            Schema::table('countries', function (Blueprint $table) {
                $table->dropColumn('deleted_at');
            });
        }

        Schema::table('countries', function (Blueprint $table) {
            DB::statement("UPDATE `countries` SET `alpha3_code` = ''");
            DB::statement("ALTER TABLE `countries` CHANGE `alpha3_code` `alpha2_code` VARCHAR(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;");
            $table->text('dial_code')->nullable()->after('alpha2_code');
        });
    }
};
