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
        Schema::table('socmed_account', function (Blueprint $table) {
            $table->uuid('created_by_id')->nullable()->after('created_at');
            $table->uuid('updated_by_id')->nullable()->after('updated_at');
            $table->uuid('deleted_by_id')->nullable()->after('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('socmed_account', 'created_by_id')) {
            Schema::table('socmed_account', function (Blueprint $table) {
                $table->dropColumn('created_by_id');
            });
        }
        
        if (Schema::hasColumn('socmed_account', 'updated_by_id')) {
            Schema::table('socmed_account', function (Blueprint $table) {
                $table->dropColumn('updated_by_id');
            });
        }

        if (Schema::hasColumn('socmed_account', 'deleted_by_id')) {
            Schema::table('socmed_account', function (Blueprint $table) {
                $table->dropColumn('deleted_by_id');
            });
        }
    }
};
