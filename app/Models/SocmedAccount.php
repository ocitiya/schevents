<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocmedAccount extends Model {
	use HasFactory, SoftDeletes;

	protected $primaryKey = "id";
	protected $table = "socmed_account";
	protected $keyType = 'string';
	
	public $incrementing = false;

	protected $casts = [
		'id' => 'string'
	];

	public function socmed () {
		return $this->belongsTo(Socmed::class);
	}

	public function created_by () {
		return $this->belongsTo(User::class);
	}
}
