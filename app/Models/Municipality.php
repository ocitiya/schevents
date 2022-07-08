<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model {
	use HasFactory;

	protected $table = "municipalities";
	protected $primaryKey = "id";

	protected $casts = [
		'id' => 'string'
	];

	public function county () {
		return $this->belongsTo(County::class);
	}
}
