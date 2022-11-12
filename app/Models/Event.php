<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model {
	use HasFactory;

	protected $table = "events";

	public function created_name () {
		return $this->belongsTo(User::class, "created_by");
	}

	public function updated_name () {
		return $this->belongsTo(User::class, "updated_by");
	}
}
