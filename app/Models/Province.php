<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model {
	use HasFactory;

	protected $table = "provinces";
	protected $primaryKey = "id";

	protected $casts = [
		'id' => 'string'
	];

	public function country () {
		return $this->belongsTo(Country::class);
	}
}
