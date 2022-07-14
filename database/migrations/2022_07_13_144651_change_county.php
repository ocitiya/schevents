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
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::table('counties', function($table) {
			$table->foreignUuid('country_id')->after('id')->references('id')->on('countries');
            $table->string('abbreviation')->after('name');
        });

        DB::statement('ALTER TABLE `counties` MODIFY `province_id` CHAR(36) NULL;');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::table('counties', function($table) {
            $table->dropForeign(['country_id']);
            $table->dropColumn('country_id');
            $table->dropColumn('abbreviation');
        });
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
};
