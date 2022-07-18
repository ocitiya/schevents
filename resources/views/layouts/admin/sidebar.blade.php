<nav id="sidebar" class="bg-primary">
  <div class="sidebar-header bg-black">
		<h3>Dashboard Admin</h3>
  </div>

  <ul class="list-unstyled components">
		{{-- <small class="title">MASTER DATA</small>
		<li class="active">
			<a data-bs-target="#homeSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
				Home
			</a>
			<ul class="collapse list-unstyled" id="homeSubmenu">
				<li>
					<a href="#">School</a>
				</li>
				<li>
					<a href="#">Home 2</a>
				</li>
				<li>
					<a href="#">Home 3</a>
				</li>
			</ul>
		</li>
		<li>
				<a href="#">About</a>
		</li> --}}
		<div class="menu-group">
			<div class="dropdown-group">
				<a data-bs-target="#masterDataMenu" data-bs-toggle="collapse"
					aria-expanded="{{ str_contains(Request::route()->getName(), 'admin.masterdata') ? 'true' : 'false' }}"
					class="dropdown-toggle">
					Master Data
				</a>
				<ul
					class="collapse list-unstyled {{ str_contains(Request::route()->getName(), 'admin.location') ? 'show' : null }}"
					id="masterDataMenu"
				>
					<li
						class="{{ str_contains(Request::route()->getName(), 'admin.location.counties') ? 'active' : null }}"
					>
						<a href="{{ route('admin.location.counties.index') }}">
							Kota
						</a>
					</li>
					<li
						class="{{ str_contains(Request::route()->getName(), 'admin.sport.type') ? 'active' : null }}"
					>
						<a href="{{ route('admin.sport.type.index') }}">
							Olahraga
						</a>
					</li>
					<li>
						<a
							href="{{ route('admin.school.index') }}"
							class="{{ str_contains(Request::route()->getName(), 'admin.school.index') ? 'active' : null }}"
						>Sekolah</a>
					</li>
					<li class="{{ str_contains(Request::route()->getName(), 'admin.masterdata.team_type.index') ? 'active' : null }}">
						<a
							href="{{ route('admin.masterdata.team_type.index') }}"
						>Tipe Tim</a>
					</li>
					<li>
						<a
							href="{{ route('admin.school.index') }}"
							class="{{ str_contains(Request::route()->getName(), 'admin.school.index') ? 'active' : null }}"
						>Federasi</a>
					</li>
					<li>
						<a
							href="{{ route('admin.school.index') }}"
							class="{{ str_contains(Request::route()->getName(), 'admin.school.index') ? 'active' : null }}"
						>Asosiasi</a>
					</li>
				</ul>
			</div>
		</div>

		<div class="menu-group">
			<li>
				<a
					href="{{ route('admin.match-schedule.index') }}"
					class="{{ str_contains(Request::route()->getName(), 'admin.match-schedule.index') ? 'active' : null }}"
				>Jadwal Pertandingan</a>
			</li>
		</div>

		<div class="menu-group">
			<div class="title">ADMIN USER</div>
			<li>
				<a href="#">List</a>
			</li>
		</div>
  </ul>

</nav>