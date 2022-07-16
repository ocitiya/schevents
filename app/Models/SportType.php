<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SportType extends Model {
	use HasFactory;
	use SoftDeletes;

	protected $table = "sport_types";
	protected $primaryKey = "id";

	protected $casts = [
		'id' => 'string'
	];
}
