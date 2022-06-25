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
		Schema::create('countries', function (Blueprint $table) {
			$table->uuid('id')->primary();
			$table->string('name');
			$table->string('alpha-2_code', 2);
			$table->string('dial_code', 5);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down () {
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		Schema::dropIfExists('countries');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}
};
