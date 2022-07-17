<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use BinaryCabin\LaravelUUID\Traits\HasUUID;

class Country extends Model {
	use HasFactory, HasUUID;

	protected $table = "countries";
	protected $primaryKey = "id";

	protected $casts = [
		'id' => 'string'
	];

	public $incrementing = false;
	protected $keyType = 'string';
}
