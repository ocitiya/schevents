<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SportType extends Model {
	use HasFactory;

	protected $table = "sport_types";
	protected $primaryKey = "id";

	protected $casts = [
		'id' => 'string'
	];
}
