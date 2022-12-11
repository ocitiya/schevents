<?php

use App\Models\Country;
use App\Models\School;
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
        $teams = School::where("is_national_team", true)->get();
        foreach($teams as $team) {
            $country = Country::find($team->country_id);
            if ($country) {
                $team->abbreviation = $country->alpha3_code;
                $team->save();
            }
        }
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
