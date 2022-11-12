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
        Schema::create('movie_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId("movie_id");
            $table->date("show_date");
            $table->string("link");
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
        Schema::dropIfExists('movie_schedules');
    }
};
