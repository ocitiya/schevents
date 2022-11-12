<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieSchedule extends Model {
	use HasFactory;

	protected $table = "movie_schedules";

	public function movie () {
		return $this->belongsTo(Movie::class);
	}

	public function created_name () {
		return $this->belongsTo(User::class, "created_by");
	}

	public function updated_name () {
		return $this->belongsTo(User::class, "updated_by");
	}
}
