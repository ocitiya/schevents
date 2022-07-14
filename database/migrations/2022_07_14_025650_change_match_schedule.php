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
        Schema::table('match_schedule', function($table) {
			$table->foreignUuid('stadium_id')->after('school2_id')->references('id')->on('stadium');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::table('match_schedule', function($table) {
            $table->dropForeign(['stadium_id']);
            $table->dropColumn('stadium_id');
        });

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
};
