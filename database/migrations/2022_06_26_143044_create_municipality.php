<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up () {
		Schema::create('municipalities', function (Blueprint $table) {
			$table->uuid('id')->primary();
			$table->foreignUuid('county_id')->references('id')->on('counties');
			$table->string('name');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down () {
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		Schema::dropIfExists('municipalities');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}
};
