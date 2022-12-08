<?php

use App\Models\Country;
use App\Models\School;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $countries = Country::get();
        foreach ($countries as $country) {
            $check = School::where("country_id", $country->id)
                ->where("is_national_team", true)
                ->first();

            if (!$check) {
                $school = new School;
                $school->id = Str::uuid();
                $school->name = $country->name;
                $school->is_national_team = true;
                $school->country_id = $country->id;

                $path = storage_path('app/public/countries/image/').$country->image;
                $newPath = storage_path('app/public/school/logo/').$country->image;
                if (file_exists($path) && !is_dir($path)) {
                    copy($path, $newPath);
                }

                $school->logo = $country->image;
                $school->save();
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
        $teams = School::where("is_national_team", true)->get();
        foreach($teams as $team) {
            $oldPath = storage_path('app/public/school/logo/').$team->logo;
            try {
                unlink($oldPath);
            } catch (Exception $e) {

            }

            $team->forceDelete();
        }
    }
};
