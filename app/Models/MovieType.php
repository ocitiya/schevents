<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MovieType extends Model {
	use HasFactory, SoftDeletes;

	protected $table = "movie_types";
	protected $hidden = ["deleted_at", "deleted_by"];
}
