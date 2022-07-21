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
            $table->uuid('federation_id')->nullable()->after('name');
            $table->uuid('association_id')->nullable()->after('federation_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('schools', 'federation_id')) {
            Schema::table('schools', function (Blueprint $table) {
                $table->dropColumn('federation_id');
            });
        }

        if (Schema::hasColumn('schools', 'association_id')) {
            Schema::table('schools', function (Blueprint $table) {
                $table->dropColumn('association_id');
            });
        }
    }
};
