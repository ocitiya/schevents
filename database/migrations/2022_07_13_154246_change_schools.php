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
      DB::statement('SET FOREIGN_KEY_CHECKS = 0');
      DB::statement('ALTER TABLE `schools` MODIFY `province_id` CHAR(36) NULL;');
      DB::statement('ALTER TABLE `schools` MODIFY `municipality_id` CHAR(36) NULL;');
      DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      // 
    }
};
