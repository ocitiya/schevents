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
          @if (inRole(["superadmin"]))
            <li
              class="{{ str_contains(Request::route()->getName(), 'admin.location.counties') ? 'active' : null }}"
            >
              <a href="{{ route('admin.location.counties.index') }}">
                State
              </a>
            </li>
          @endif

          @if (inRole(["superadmin", "admin", "user"]))
            <li
              class="{{ str_contains(Request::route()->getName(), 'admin.location.municipalities') ? 'active' : null }}"
            >
              <a href="{{ route('admin.location.municipalities.index') }}">
                Kota
              </a>
            </li>
          @endif

          @if (inRole(["superadmin"]))
            <li
              class="{{ Request::route()->getName() == 'admin.sport.index' ? 'active' : null }}"
            >
              <a href="{{ route('admin.sport.index') }}">
                Tipe Olahraga
              </a>
            </li>
          @endif

          @if (inRole(["superadmin"]))
            <li
              class="{{ str_contains(Request::route()->getName(), 'admin.sport.type') ? 'active' : null }}"
            >
              <a href="{{ route('admin.sport.type.index') }}">
                Link Stream
              </a>
            </li>
          @endif

          @if (inRole(["superadmin", "admin", "user"]))
            <li
              class="{{ str_contains(Request::route()->getName(), 'admin.school.index') ? 'active' : null }}"
            >
              <a
                href="{{ route('admin.school.index') }}"
              >Sekolah</a>
            </li>
          @endif

          @if (inRole(["superadmin"]))
            <li class="{{ str_contains(Request::route()->getName(), 'admin.masterdata.team_type.index') ? 'active' : null }}">
              <a
                href="{{ route('admin.masterdata.team_type.index') }}"
              >Tipe Tim</a>
            </li>
          @endif

          @if (inRole(["superadmin", "admin", "user"]))
            <li class="{{ str_contains(Request::route()->getName(), 'admin.masterdata.stadium.index') ? 'active' : null }}">
              <a
                href="{{ route('admin.masterdata.stadium.index') }}"
              >Stadium</a>
            </li>
          @endif

          @if (inRole(["superadmin"]))
            <li
              class="{{ str_contains(Request::route()->getName(), 'admin.masterdata.federation') ? 'active' : null }}"
            >
              <a
                href="{{ route('admin.masterdata.federation.index') }}"
              >Federasi</a>
            </li>
          @endif

          @if (inRole(["superadmin", "admin"]))
            <li
              class="{{ str_contains(Request::route()->getName(), 'admin.masterdata.association') ? 'active' : null }}"
            >
              <a
                href="{{ route('admin.masterdata.association.index') }}"
              >Asosiasi</a>
            </li>
          @endif

          @if (inRole(["superadmin"]))
            <li
              class="{{ str_contains(Request::route()->getName(), 'admin.masterdata.socmed') ? 'active' : null }}"
            >
              <a
                href="{{ route('admin.masterdata.socmed.index') }}"
              >Sosmed</a>
            </li>
          @endif

          @if (inRole(["user", "superadmin", "admin"]))
            <li
              class="{{ str_contains(Request::route()->getName(), 'admin.masterdata.socmed-account') ? 'active' : null }}"
            >
              <a
                href="{{ route('admin.masterdata.socmed-account.index') }}"
              >Akun Sosmed</a>
            </li>
          @endif
        </ul>
      </div>
    </div>
  
    @if(inRole(["superadmin", "admin"]))
      <li
        class="{{ str_contains(Request::route()->getName(), 'admin.match-schedule.federation.index') ? 'active' : null }}"
      >
        <a
          href="{{ route('admin.match-schedule.federation.index') }}"
        >Jadwal Federasi</a>
      </li>
    @endif

    @if(inRole(["superadmin", "admin", "user"]))
      <li
        class="{{ str_contains(Request::route()->getName(), 'admin.match-schedule.index') ? 'active' : null }}"
      >
        <a
          href="{{ route('admin.match-schedule.index') }}"
        >Jadwal Pertandingan</a>
      </li>
    @endif

    @if(inRole(["superadmin"]))
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
              class="{{ str_contains(Request::route()->getName(), 'admin.app.banner') ? 'active' : null }}"
            >
              <a href="{{ route('admin.app.banner.index') }}">
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
    @endif

    @if(inRole(["superadmin"]))
      <div class="menu-group">
        <div class="title">ADMIN USER</div>
        <li
          class="{{ str_contains(Request::route()->getName(), 'admin.user.index') ? 'active' : null }}"
        >
          <a
            href="{{ route('admin.user.index') }}"
          >List</a>
        </li>
      </div>
    @endif
  </ul>
</nav>