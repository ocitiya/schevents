<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LPMovies extends Model {
	use HasFactory;

	protected $table = "lp_movies";

  public function channel () {
    return $this->belongsTo(OfferChannel::class);
  }

  public function type () {
    return $this->belongsTo(LPTypes::class, "lp_type_id");
  }
}
