<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stadium extends Model {
	use HasFactory, SoftDeletes;
 
	protected $table = "stadium";
	protected $primaryKey = "id";

	protected $casts = [
		'id' => 'string'
	];

	public $incrementing = false;
	protected $keyType = 'string';

	public function country () {
		return $this->belongsTo(Country::class);
	}

	public function province () {
		return $this->belongsTo(Province::class);
	}

	public function county () {
		return $this->belongsTo(County::class);
	}

	public function municipality () {
		return $this->belongsTo(Municipality::class);
	}
}
