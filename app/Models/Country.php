<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use BinaryCabin\LaravelUUID\Traits\HasUUID;
use BinaryCabin\LaravelUUID\Traits\UUIDIsPrimaryKey;

class Country extends Model {
	use HasFactory, HasUUID, UUIDIsPrimaryKey;

	protected $table = "countries";
	protected $primaryKey = "id";

	protected $casts = [
		'id' => 'string'
	];
}
