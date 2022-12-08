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
        Schema::table('schools', function (Blueprint $table) {
            $table->boolean("is_national_team")
                ->default(0)
                ->after("nickname");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('schools', 'is_national_team')) {
            Schema::table('schools', function (Blueprint $table) {
                $table->dropColumn('is_national_team');
            });
        }
    }
};
