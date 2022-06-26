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
		Schema::create('provinces', function (Blueprint $table) {
			$table->uuid('id')->primary();
			$table->foreignUuid('country_id')->references('id')->on('countries');
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
		Schema::dropIfExists('provinces');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}
};
