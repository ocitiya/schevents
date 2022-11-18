<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offers extends Model {
	use HasFactory;

	protected $table = "offers";
	protected $primaryKey = "id";

  public function campaign() {
    return $this->belongsTo(OfferCampaign::class);
  }

  public function banner() {
    return $this->belongsTo(OfferBanner::class);
  }

  public function channel() {
    return $this->belongsTo(OfferChannel::class);
  }
}
