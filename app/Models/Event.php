<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model {
	use HasFactory;

	protected $table = "events";
	protected $appends = ['offer'];

	public function created_name () {
		return $this->belongsTo(User::class, "created_by");
	}

	public function updated_name () {
		return $this->belongsTo(User::class, "updated_by");
	}

	public function campaign () {
		return $this->belongsTo(OfferCampaign::class);
	}

	public function banner () {
		return $this->belongsTo(OfferBanner::class);
	}

	public function channel () {
		return $this->belongsTo(OfferChannel::class);
	}

	public function getOfferAttribute () {
		return Offers::where("campaign_id", $this->campaign_id)
			->where("banner_id", $this->banner_id)
			->where("channel_id", $this->channel_id)
			->first();
	}
}
