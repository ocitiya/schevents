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

	public $incrementing = false;
	protected $keyType = 'string';

	public function user () {
		return $this->belongsTo(User::class);
	}

	public function created_name () {
		return $this->belongsTo(User::class, "created_by");
	}

	public function updated_name () {
		return $this->belongsTo(User::class, "updated_by");
	}
}
