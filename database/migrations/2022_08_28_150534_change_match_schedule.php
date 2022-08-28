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
            $table->uuid('stadium_id')->nullable()->after('stadium');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('match_schedule', 'stadium_id')) {
            Schema::table('match_schedule', function (Blueprint $table) {
                $table->dropColumn('stadium_id');
            });
        }
    }
};
