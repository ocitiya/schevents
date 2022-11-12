<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model {
	use HasFactory, SoftDeletes;

	protected $table = "movies";

	function movie_type () {
		return $this->belongsTo(MovieType::class);
	}
}
