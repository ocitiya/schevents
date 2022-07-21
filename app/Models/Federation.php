<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Federation extends Model {
	use HasFactory, SoftDeletes;

	protected $table = "federation";
	protected $primaryKey = "id";

	protected $casts = [
		'id' => 'string'
	];

	public $incrementing = false;
	protected $keyType = 'string';

  public function associations () {
    return $this->hasMany(Association::class);
  }
}
