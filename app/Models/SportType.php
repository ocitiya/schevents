<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use BinaryCabin\LaravelUUID\Traits\HasUUID;

class SportType extends Model {
	use HasFactory, SoftDeletes, HasUUID;

	protected $table = "sport_types";
	protected $primaryKey = "id";

	protected $casts = [
		'id' => 'string'
	];

	public $incrementing = false;
	protected $keyType = 'string';
}
