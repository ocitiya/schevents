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
            $table->uuid('federation_id')->nullable()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('sport_types', 'event_id')) {
            Schema::table('sport_types', function (Blueprint $table) {
                $table->dropColumn('event_id');
            });
        }
    }
};
