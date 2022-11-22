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
        Schema::create('lp_types', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->timestamp('created_at')->nullable();
            $table->foreignUuid('created_by');
            $table->timestamp('updated_at')->nullable();
            $table->foreignUuid('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lp_types');
    }
};
