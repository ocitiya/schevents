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
        Schema::create('match_schedule', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('sport_type_id');
            $table->uuid('school1_id');
            $table->uuid('school2_id');
            $table->uuid('county_id');
			$table->enum('team_gender', ['boy', 'girl']);
            $table->text('stadium')->nullable();
            $table->uuid('team_type_id');
            $table->dateTime('datetime', $precision = 0)->comment('UTC Timezone');
            $table->text('keywords');
            $table->text('description')->nullable();
            $table->boolean('is_expire')->default(0);
			$table->timestamps();
            $table->uuid('created_by');
            $table->uuid('updated_by')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('match_schedule');
    }
};
