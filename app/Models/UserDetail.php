<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model {
	use HasFactory;

	protected $table = "users_detail";
	protected $primaryKey = "id";

	protected $casts = [
		'id' => 'string'
	];
}
