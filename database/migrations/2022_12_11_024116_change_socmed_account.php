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
        if (Schema::hasColumn('socmed_account', 'federation_id')) {
            Schema::table('socmed_account', function (Blueprint $table) {
                $table->dropColumn('federation_id');
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
        Schema::table('socmed_account', function (Blueprint $table) {
            $table->foreignUuid("socmed_account")
                ->nullable()
                ->after("socmed_id");
        });
    }
};
