<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Socmed extends Model {
	use HasFactory, SoftDeletes;

	protected $primaryKey = "id";
	protected $table = "socmed";
	protected $keyType = 'string';
	
	public $incrementing = false;

	protected $casts = [
		'id' => 'string'
	];
}
