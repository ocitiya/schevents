<nav id="sidebar" class="bg-primary">
  <div class="sidebar-header bg-black">
		<h3>Dashboard Admin</h3>
  </div>

  <ul class="list-unstyled components">
		<li
			class="{{ str_contains(Request::route()->getName(), 'admin.dashboard') ? 'active' : null }}"
		>
			<a
				href="{{ route('admin.dashboard') }}"
			>Dashboard</a>
		</li>

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
							State
						</a>
					</li>
					<li
						class="{{ str_contains(Request::route()->getName(), 'admin.location.municipalities') ? 'active' : null }}"
					>
						<a href="{{ route('admin.location.municipalities.index') }}">
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
					<li
						class="{{ str_contains(Request::route()->getName(), 'admin.school.index') ? 'active' : null }}"
					>
						<a
							href="{{ route('admin.school.index') }}"
						>Sekolah</a>
					</li>
					<li class="{{ str_contains(Request::route()->getName(), 'admin.masterdata.team_type.index') ? 'active' : null }}">
						<a
							href="{{ route('admin.masterdata.team_type.index') }}"
						>Tipe Tim</a>
					</li>
					<li class="{{ str_contains(Request::route()->getName(), 'admin.masterdata.stadium.index') ? 'active' : null }}">
						<a
							href="{{ route('admin.masterdata.stadium.index') }}"
						>Stadium</a>
					</li>
					<li
						class="{{ str_contains(Request::route()->getName(), 'admin.masterdata.federation') ? 'active' : null }}"
					>
						<a
							href="{{ route('admin.masterdata.federation.index') }}"
						>Federasi</a>
					</li>
					<li
						class="{{ str_contains(Request::route()->getName(), 'admin.masterdata.association') ? 'active' : null }}"
					>
						<a
							href="{{ route('admin.masterdata.association.index') }}"
						>Asosiasi</a>
					</li>
				</ul>
			</div>
		</div>
	
		<li
			class="{{ str_contains(Request::route()->getName(), 'admin.match-schedule.federation.index') ? 'active' : null }}"
		>
			<a
				href="{{ route('admin.match-schedule.federation.index') }}"
			>Jadwal Federasi</a>
		</li>

		<li
			class="{{ str_contains(Request::route()->getName(), 'admin.match-schedule.index') ? 'active' : null }}"
		>
			<a
				href="{{ route('admin.match-schedule.index') }}"
			>Jadwal Pertandingan</a>
		</li>

		<div class="menu-group">
			<div class="dropdown-group">
				<a data-bs-target="#appSetting" data-bs-toggle="collapse"
					aria-expanded="{{ str_contains(Request::route()->getName(), 'admin.masterdata') ? 'true' : 'false' }}"
					class="dropdown-toggle">
					Pengaturan Aplikasi
				</a>
				<ul
					class="collapse list-unstyled {{ str_contains(Request::route()->getName(), 'admin.location') ? 'show' : null }}"
					id="appSetting"
				>
					<li
						class="{{ str_contains(Request::route()->getName(), 'admin.location.counties') ? 'active' : null }}"
					>
						<a href="{{ route('admin.location.counties.index') }}">
							Profile
						</a>
					</li>
					<li
						class="{{ str_contains(Request::route()->getName(), 'admin.sport.type') ? 'active' : null }}"
					>
						<a href="{{ route('admin.sport.type.index') }}">
							Kontak
						</a>
					</li>
					<li
						class="{{ str_contains(Request::route()->getName(), 'admin.sport.type') ? 'active' : null }}"
					>
						<a href="{{ route('admin.sport.type.index') }}">
							Banner
						</a>
					</li>
					<li
						class="{{ str_contains(Request::route()->getName(), 'admin.school.index') ? 'active' : null }}"
					>
						<a
							href="{{ route('admin.school.index') }}"
						>Follow Us</a>
					</li>
				</ul>
			</div>
		</div>

		<div class="menu-group">
			<div class="title">ADMIN USER</div>
			<li>
				<a href="#">List</a>
			</li>
		</div>
  </ul>
</nav>