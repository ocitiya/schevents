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
            $table->boolean("is_national_team")
                ->default(0)
                ->after("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('match_schedule', 'is_national_team')) {
            Schema::table('match_schedule', function (Blueprint $table) {
                $table->dropColumn('is_national_team');
            });
        }
    }
};
