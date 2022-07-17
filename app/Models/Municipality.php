<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use BinaryCabin\LaravelUUID\Traits\HasUUID;

class Municipality extends Model {
	use HasFactory, HasUUID;

	protected $table = "municipalities";
	protected $primaryKey = "id";

	protected $casts = [
		'id' => 'string'
	];

	public $incrementing = false;
	protected $keyType = 'string';

	public function county () {
		return $this->belongsTo(County::class);
	}
}
