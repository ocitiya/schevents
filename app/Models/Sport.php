<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sport extends Model {
	use HasFactory, SoftDeletes;

	protected $primaryKey = "id";
	protected $table = "sport";
	protected $keyType = 'string';
	
	public $incrementing = false;

	protected $casts = [
		'id' => 'string'
	];

	public function sport_types () {
		return $this->hasMany(SportType::class);
	}
}
