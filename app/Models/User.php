<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable {
	use HasApiTokens, HasFactory, Notifiable;

	protected $table = "users";
	protected $primaryKey = "id";

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
		'password',
		'token',
		'remember_token'
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	// protected $casts = [
	// 	'email_verified_at' => 'datetime',
	// ];

	public function setPasswordAttribute ($password) {
		$this->attributes['password'] = bcrypt($password);
	}

	protected $casts = [
		'id' => 'string'
	];

	public function user_detail () {
		return $this->hasOne(UserDetail::class, 'user_id', 'id');
	}

}
