<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use BinaryCabin\LaravelUUID\Traits\HasUUID;
use BinaryCabin\LaravelUUID\Traits\UUIDIsPrimaryKey;

class Province extends Model {
	use HasFactory, HasUUID, UUIDIsPrimaryKey;

	protected $table = "provinces";
	protected $primaryKey = "id";

	protected $casts = [
		'id' => 'string'
	];

	public function country () {
		return $this->belongsTo(Country::class);
	}
}
