<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MovieMovieType extends Model {
	use HasFactory;

	protected $table = "movie_movie_types";
  public $timestamps = false;

	function movie_type () {
		return $this->belongsTo(MovieType::class);
	}

  function movie () {
		return $this->belongsTo(Movie::class);
  }
}
