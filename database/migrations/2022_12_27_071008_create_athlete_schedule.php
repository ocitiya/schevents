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
        Schema::create('athlete_schedule', function (Blueprint $table) {
            $table->id();
            $table->foreignId("championship_id")->nullable();
            $table->foreignUuid("federation_id")->nullable();
            $table->foreignUuid("sport_id");
            $table->foreignUuid("athlete1_id");
            $table->enum("match_system", ["home", "away", "neutral"])->nullable();
            $table->foreignUuid("athlete2_id");
            $table->enum("match_system2", ["home", "away", "neutral"])->nullable();
            $table->enum("team_gender", ["boy", "girl"])->nullable();
            $table->foreignUuid("stadium_id")->nullable();
            $table->foreignUuid("team_type_id")->nullable();
            $table->dateTime("datetime");
            $table->text("keywords");
            $table->text("description")->nullable();
            $table->foreignId("lp_type_id")->nullable();
            $table->foreignId("channel_id")->nullable();
            $table->boolean("is_expire")->default(false);
            $table->timestamp("created_at")->useCurrent();
            $table->timestamp("updated_at")->nullable()->useCurrentOnUpdate();
            $table->foreignUuid("created_by");
            $table->foreignUuid("updated_by")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('athlete_schedule');
    }
};
