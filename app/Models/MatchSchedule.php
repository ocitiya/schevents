<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use BinaryCabin\LaravelUUID\Traits\HasUUID;
use BinaryCabin\LaravelUUID\Traits\UUIDIsPrimaryKey;


class MatchSchedule extends Model {
	use HasFactory, SoftDeletes, HasUUID, UUIDIsPrimaryKey;

	protected $table = "match_schedule";
	protected $primaryKey = "id";

	protected $casts = [
		'id' => 'string'
	];

	public function sport_type () {
		return $this->belongsTo(SportType::class, 'sport_type_id');
	}

	public function school1 () {
		return $this->belongsTo(School::class, 'school1_id')->withTrashed();
	}

	public function school2 () {
		return $this->belongsTo(School::class, 'school2_id')->withTrashed();
	}

	public function county () {
		return $this->belongsTo(County::class);
	}

	public function team_type () {
		return $this->belongsTo(TeamType::class);
	}
}
