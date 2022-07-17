<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use BinaryCabin\LaravelUUID\Traits\HasUUID;
use BinaryCabin\LaravelUUID\Traits\UUIDIsPrimaryKey;

class App extends Model {
	use HasFactory, HasUUID, UUIDIsPrimaryKey;

	protected $table = "app";
	protected $primaryKey = "id";
	protected $casts = [
		'id' => 'string'
	];
}
