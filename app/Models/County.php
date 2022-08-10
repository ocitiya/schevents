<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class County extends Model {
	use HasFactory;

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

	public function municipality () {
		return $this->hasMany(Municipality::class);
	}
}
