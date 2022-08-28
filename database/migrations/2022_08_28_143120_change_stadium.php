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
        Schema::table('stadium', function (Blueprint $table) {
            $table->string('nickname')->nullable()->after('municipality_id');
            $table->text('address')->nullable()->after('nickname');
            $table->string('owner')->nullable()->after('address');
            $table->text('capacity')->nullable()->after('owner');
            $table->text('surface')->nullable()->after('capacity');
            $table->string('image')->nullable()->after('surface');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('stadium', 'nickname')) {
            Schema::table('stadium', function (Blueprint $table) {
                $table->dropColumn('nickname');
            });
        }

        if (Schema::hasColumn('stadium', 'address')) {
            Schema::table('stadium', function (Blueprint $table) {
                $table->dropColumn('address');
            });
        }

        if (Schema::hasColumn('stadium', 'owner')) {
            Schema::table('stadium', function (Blueprint $table) {
                $table->dropColumn('owner');
            });
        }

        if (Schema::hasColumn('stadium', 'capacity')) {
            Schema::table('stadium', function (Blueprint $table) {
                $table->dropColumn('capacity');
            });
        }

        if (Schema::hasColumn('stadium', 'surface')) {
            Schema::table('stadium', function (Blueprint $table) {
                $table->dropColumn('surface');
            });
        }

        if (Schema::hasColumn('stadium', 'image')) {
            Schema::table('stadium', function (Blueprint $table) {
                $table->dropColumn('image');
            });
        }
    }
};
