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
			$table->foreignUuid('sport_type_id')->references('id')->on('sport_types');
			$table->foreignUuid('school1_id')->references('id')->on('schools');
			$table->foreignUuid('school2_id')->references('id')->on('schools');
			$table->enum('team_gender', ['all', 'male', 'female']);
            $table->dateTime('datetime', $precision = 0)->comment('UTC Timezone');
            $table->text('link');
            $table->text('keywords');
            $table->boolean('is_expire')->default(0);
			$table->timestamps();
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
