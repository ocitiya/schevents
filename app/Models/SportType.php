<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SportType extends Model {
	use HasFactory, SoftDeletes;

	protected $primaryKey = "id";
	protected $table = "sport_types";
	protected $keyType = 'string';
	
	public $incrementing = false;

	protected $casts = [
		'id' => 'string'
	];

	public function federation() {
		return $this->belongsTo(Federation::class);
	}
}
