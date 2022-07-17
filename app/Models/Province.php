<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use BinaryCabin\LaravelUUID\Traits\HasUUID;

class Province extends Model {
	use HasFactory, HasUUID;

	protected $table = "provinces";
	protected $primaryKey = "id";

	protected $casts = [
		'id' => 'string'
	];

	public $incrementing = false;
	protected $keyType = 'string';

	public function country () {
		return $this->belongsTo(Country::class);
	}
}
