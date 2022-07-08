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
        Schema::create('schools', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->string('name');
			$table->foreignUuid('country_id')->references('id')->on('countries');
			$table->foreignUuid('province_id')->references('id')->on('provinces');
			$table->foreignUuid('county_id')->references('id')->on('counties');
			$table->foreignUuid('municipality_id')->references('id')->on('municipalities');
			$table->string('logo');
			$table->enum('level_of_education', ['kindergarden', 'elementary school', 'junior high school', 'senior high school', 'vocational school', 'university', 'college']);
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
        Schema::dropIfExists('schools');
    }
};
