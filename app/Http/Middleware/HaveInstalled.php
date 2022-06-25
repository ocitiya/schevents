<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\App;
use App\Models\UserDetail;

class HaveInstalled {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
	 * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
	 */
	public function handle(Request $request, Closure $next) {
		$haveInstalled = false;

		$appData = App::count();
		$sysAdminData = UserDetail::where('level', 'sysadmin')->count();

		if ($appData > 0 && $sysAdminData > 0) $haveInstalled = true;

		if ($haveInstalled) {
			return $next($request);
		} else {
			return redirect()->route('install');
		}
	}
}
