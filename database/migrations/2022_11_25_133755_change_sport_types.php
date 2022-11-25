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
        if (Schema::hasColumn('sport_types', 'stream_url')) {
            Schema::table('sport_types', function (Blueprint $table) {
                $table->dropColumn('stream_url');
            });
        }

        Schema::table('sport_types', function (Blueprint $table) {
            $table->text('image')->nullable()->after('federation_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('sport_types', 'image')) {
            Schema::table('sport_types', function (Blueprint $table) {
                $table->dropColumn('image');
            });
        }

        Schema::table('sport_types', function (Blueprint $table) {
            $table->text('stream_url')->nullable()->after('federation_id');
        });
    }
};
