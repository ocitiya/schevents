<nav id="sidebar" class="bg-primary">
  <div class="sidebar-header bg-black">
		<h3>Admin Dashboard</h3>
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
				<div class="title">MASTER DATA</div>
				<li
					class="{{ str_contains(Request::route()->getName(), 'admin.countries') ? 'active' : null }}"
				>
					<a href="{{ route('admin.countries.index') }}">
						Countries
					</a>
				</li>
				<li>
					<a href="#">Provinces</a>
				</li>
				<li>
					<a href="#">County</a>
				</li>
				<li>
					<a href="#">Municipality</a>
				</li>
				<li>
					<a href="#">Locality</a>
				</li>
				<li>
					<a href="#">School</a>
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