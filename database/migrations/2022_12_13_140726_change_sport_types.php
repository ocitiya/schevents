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
            $table->foreignId("championship_id")
                ->nullable()
                ->after("federation_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('sport_types', 'championship_id')) {
            Schema::table('sport_types', function (Blueprint $table) {
                $table->dropColumn('championship_id');
            });
        }
    }
};
