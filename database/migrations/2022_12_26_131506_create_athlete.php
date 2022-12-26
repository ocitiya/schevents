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
        Schema::create('athlete', function (Blueprint $table) {
            $table->id();
            $table->string("name");
			$table->enum("gender", ["male", "female"]);
			$table->date("date_of_birth")->nullable();
			$table->integer("height")->nullable();
			$table->integer("weight")->nullable();
			$table->string("nickname")->nullable();
			$table->string("surname")->nullable();
			$table->uuid("country_id")->nullable();
			$table->uuid("county_id")->nullable();
			$table->uuid("municipality_id")->nullable();
			$table->string("wingspan")->nullable();
			$table->integer("age")->nullable();
			$table->uuid("federation_id");
			$table->uuid("association_id")->nullable();
			$table->string("image")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('athlete');
    }
};
