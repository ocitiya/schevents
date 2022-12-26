<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Athlete extends Model {
	use HasFactory;

	protected $table = "athlete";
	protected $primaryKey = "id";

	public function federation () {
		return $this->belongsTo(Federation::class);
	}

	public function association () {
		return $this->belongsTo(Association::class);
	}

	public function country () {
		return $this->belongsTo(Country::class);
	}

	public function county () {
		return $this->belongsTo(County::class);
	}

	public function municipality () {
		return $this->belongsTo(Municipality::class);
	}
}
