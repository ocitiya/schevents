<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use BinaryCabin\LaravelUUID\Traits\HasUUID;
use BinaryCabin\LaravelUUID\Traits\UUIDIsPrimaryKey;

class Municipality extends Model {
	use HasFactory, HasUUID, UUIDIsPrimaryKey;

	protected $table = "municipalities";
	protected $primaryKey = "id";

	protected $casts = [
		'id' => 'string'
	];

	public function county () {
		return $this->belongsTo(County::class);
	}
}
