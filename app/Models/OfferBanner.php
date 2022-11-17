<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferBanner extends Model {
	use HasFactory;

	protected $table = "offer_banner";
	protected $primaryKey = "id";

	public function campaign () {
		return $this->belongsTo(OfferCampaign::class);
	}
}
