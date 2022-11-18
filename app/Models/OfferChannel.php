<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferChannel extends Model {
	use HasFactory;

	protected $table = "offer_channel";
	protected $primaryKey = "id";

  public function user() {
    return $this->belongsTo(User::class);
  }
}
