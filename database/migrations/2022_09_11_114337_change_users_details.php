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
        DB::statement("ALTER TABLE `users_detail` CHANGE `level` `level` ENUM('superadmin','admin','user') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;");
        Schema::table('users_detail', function (Blueprint $table) {
			$table->text('address')->nullable()->after('avatar');
			$table->string('facebook')->nullable()->after('address');
			$table->string('instagram')->nullable()->after('facebook');
			$table->string('twitter')->nullable()->after('instagram');
			$table->uuid('user_id')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE `users_detail` CHANGE `level` `level` ENUM('sysadmin','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;");
        if (Schema::hasColumn('users_detail', 'address')) {
            Schema::table('users_detail', function (Blueprint $table) {
                $table->dropColumn('address');
            });
        }

        if (Schema::hasColumn('users_detail', 'facebook')) {
            Schema::table('users_detail', function (Blueprint $table) {
                $table->dropColumn('facebook');
            });
        }

        if (Schema::hasColumn('users_detail', 'instagram')) {
            Schema::table('users_detail', function (Blueprint $table) {
                $table->dropColumn('instagram');
            });
        }

        if (Schema::hasColumn('users_detail', 'twitter')) {
            Schema::table('users_detail', function (Blueprint $table) {
                $table->dropColumn('twitter');
            });
        }

        if (Schema::hasColumn('users_detail', 'user_id')) {
            Schema::table('users_detail', function (Blueprint $table) {
                $table->dropColumn('user_id');
            });
        }
    }
};
