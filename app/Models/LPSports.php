<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LPSports extends Model {
	use HasFactory;

	protected $table = "lp_sports";

  public function channel () {
    return $this->belongsTo(OfferChannel::class);
  }

  public function type () {
    return $this->belongsTo(LPTypes::class, "lp_type_id");
  }
}
