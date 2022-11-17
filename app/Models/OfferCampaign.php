<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferCampaign extends Model {
	use HasFactory;

	protected $table = "offer_campaign";
	protected $primaryKey = "id";
}
