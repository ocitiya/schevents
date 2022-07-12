<nav id="sidebar" class="bg-primary">
  <div class="sidebar-header bg-black">
		<h3>Admin Dashboard</h3>
  </div>

  <ul class="list-unstyled components">
		<div class="menu-group">
			<div class="title">MATCH</div>
			<li>
				<a
					href="{{ route('admin.match-schedule.index') }}"
					class="{{ str_contains(Request::route()->getName(), 'admin.match-schedule.index') ? 'active' : null }}"
				>Match Schedule</a>
			</li>
		</div>
		
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
			<div class="title">MASTER DATA</div>
			<div class="dropdown-group">
				<a data-bs-target="#locationSubmenu" data-bs-toggle="collapse"
					aria-expanded="{{ str_contains(Request::route()->getName(), 'admin.location') ? 'true' : 'false' }}"
					class="dropdown-toggle">
					Location
				</a>
				<ul
					class="collapse list-unstyled {{ str_contains(Request::route()->getName(), 'admin.location') ? 'show' : null }}"
					id="locationSubmenu"
				>
					<li
						class="{{ str_contains(Request::route()->getName(), 'admin.location.countries') ? 'active' : null }}"
					>
						<a href="{{ route('admin.location.countries.index') }}">
							Countries
						</a>
					</li>

					<li
						class="{{ str_contains(Request::route()->getName(), 'admin.location.provinces') ? 'active' : null }}"
					>
						<a href="{{ route('admin.location.provinces.index') }}">
							Provinces
						</a>
					</li>

					<li
						class="{{ str_contains(Request::route()->getName(), 'admin.location.counties') ? 'active' : null }}"
					>
						<a href="{{ route('admin.location.counties.index') }}">
							Counties
						</a>
					</li>
					
					<li
						class="{{ str_contains(Request::route()->getName(), 'admin.location.municipalities') ? 'active' : null }}"
					>
						<a href="{{ route('admin.location.municipalities.index') }}">
							Municipalities
						</a>
					</li>
					{{-- <li
						class="{{ str_contains(Request::route()->getName(), 'admin.location.localities') ? 'active' : null }}"
					>
						<a href="{{ route('admin.location.localities.index') }}">
							Counties
						</a>
					</li> --}}
				</ul>
			</div>

			<div class="dropdown-group">
				<a data-bs-target="#sportSubMenu" data-bs-toggle="collapse"
					aria-expanded="{{ str_contains(Request::route()->getName(), 'admin.sport') ? 'true' : 'false' }}"
					class="dropdown-toggle">
					Sport
				</a>
				<ul
					class="collapse list-unstyled {{ str_contains(Request::route()->getName(), 'admin.sport') ? 'show' : null }}"
					id="sportSubMenu"
				>
					<li
						class="{{ str_contains(Request::route()->getName(), 'admin.sport.type') ? 'active' : null }}"
					>
						<a href="{{ route('admin.sport.type.index') }}">
							Type
						</a>
					</li>
				</ul>
			</div>

			<li>
				<a
					href="{{ route('admin.school.index') }}"
					class="{{ str_contains(Request::route()->getName(), 'admin.school.index') ? 'active' : null }}"
				>School</a>
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