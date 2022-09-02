<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MatchSchedule extends Model {
	use HasFactory, SoftDeletes;

	protected $table = "match_schedule";
	protected $primaryKey = "id";
	public $timestamps = false;

	protected $casts = [
		'id' => 'string'
	];

	public $incrementing = false;
	protected $keyType = 'string';

	public function sport_type () {
		return $this->belongsTo(SportType::class, 'sport_type_id', 'id');
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

	public function county2 () {
		return $this->belongsTo(County::class, 'county2_id');
	}

	public function team_type () {
		return $this->belongsTo(TeamType::class);
	}

	public function federation () {
		return $this->belongsTo(Federation::class);
	}

	public function stadium () {
		return $this->belongsTo(Stadium::class);
	}

	public function createdBy () {
		return $this->belongsTo(User::class, "created_by");
	}

	public function updatedBy () {
		return $this->belongsTo(User::class, "updated_by");
	}
}
