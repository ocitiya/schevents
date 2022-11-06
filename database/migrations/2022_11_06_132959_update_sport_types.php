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
            $table->foreignUuid('created_by')->nullable()->after('stream_url');
        });

        if (Schema::hasColumn('sport_types', 'image')) {
            Schema::table('sport_types', function (Blueprint $table) {
                $table->dropColumn('image');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
