<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use BinaryCabin\LaravelUUID\Traits\HasUUID;

class County extends Model {
	use HasFactory, HasUUID;

	protected $table = "counties";
	protected $primaryKey = "id";

	protected $casts = [
		'id' => 'string'
	];

	public $incrementing = false;
	protected $keyType = 'string';

	public function province () {
		return $this->belongsTo(Province::class);
	}

	public function schools () {
		return $this->hasMany(School::class);
	}

	public function match () {
		return $this->hasMany(MatchSchedule::class, 'county_id');
	}
}
