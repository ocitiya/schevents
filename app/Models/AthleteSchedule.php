<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AthleteSchedule extends Model {
	use HasFactory;

	protected $table = "athlete_schedule";
	protected $primaryKey = "id";
	protected $appends = ['lpsport', 'link_stream'];

	public function sport_type () {
		return $this->belongsTo(SportType::class, 'sport_type_id', 'id');
	}

	public function sport () {
		return $this->belongsTo(Sport::class)->withTrashed();
	}

	public function athlete1 () {
		return $this->belongsTo(Athlete::class, 'athlete1_id');
	}

	public function athlete2 () {
		return $this->belongsTo(Athlete::class, 'athlete2_id');
	}

	public function county () {
		return $this->belongsTo(County::class)->withTrashed();
	}

	public function county2 () {
		return $this->belongsTo(County::class, 'county2_id')->withTrashed();
	}

	public function team_type () {
		return $this->belongsTo(TeamType::class);
	}

	public function federation () {
		return $this->belongsTo(Federation::class);
	}

	public function stadium () {
		return $this->belongsTo(Stadium::class);
	}

	public function createdBy () {
		return $this->belongsTo(User::class, "created_by");
	}

	public function updatedBy () {
		return $this->belongsTo(User::class, "updated_by");
	}

	public function lp_type () {
		return $this->belongsTo(LPTypes::class, "lp_type_id");
	}

	public function channel () {
		return $this->belongsTo(OfferChannel::class, "channel_id");
	}

	public function championship () {
		return $this->belongsTo(Championships::class);
	}

	public function getLpsportAttribute () {
		return LPSports::where("lp_type_id", $this->lp_type_id)
			->where("channel_id", $this->channel_id)
			->first();
	}

	public function getLinkStreamAttribute () {
		if (empty($this->championship_id) || empty($this->sport_id)) {
			return (object) ["image" => null];
		} else {
			$linkStream = SportType::where("championship_id", $this->championship_id)
				->where("sport_id", $this->sport_id)
				->first();

			if (!$linkStream) {
				return (object) ["image" => null];
			} else {
				$linkStream->image_link = asset("storage/link_stream/image/{$linkStream->image}");
				return $linkStream;
			}
		}
	}
}
