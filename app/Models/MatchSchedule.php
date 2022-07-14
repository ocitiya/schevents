<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MatchSchedule extends Model {
    use HasFactory;
    use SoftDeletes;

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

	public function stadium () {
		return $this->belongsTo(Stadium::class)->withTrashed();
	}
}
