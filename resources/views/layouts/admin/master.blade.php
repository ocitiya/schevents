@php
  use App\Models\App;
  $app = App::first();
@endphp

<html>
  <head>
    <title>Dashboard</title>

    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans&display=swap" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2-bootstrap-5-theme.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/main.css') }}" rel="stylesheet">
  
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  <body>
    <div class="wrapper">
      @include('layouts.admin.sidebar')

      <div id="content-navbar">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">
            <button type="button" id="sidebarCollapse" class="btn btn-outline-primary unrounded">
              <i class="fa-solid fa-bars"></i>
            </button>

            <div>
              {{ $app->name }}
            </div>

            <div class="d-flex">
              <div class="dropdown">
                <button class="btn btn-light text-black-75 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <div class="pe-4">
                    {{ Auth::user()->name }}
                    ({{ Session::get("role") }})
                  </div>
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="{{ route("admin.my-account") }}">Akun Saya</a></li>
                  <li><a class="dropdown-item" href="{{ route("admin.my-account.change-password") }}">Ganti Password</a></li>
                </ul>
              </div>

              <a href="{{ route('admin.logout') }}" class="btn btn-danger d-flex align-items-center">
                <i class="fa-solid fa-right-from-bracket"></i>
              </a>
            </div>
          </div>
        </nav>

        @yield('content')
      </div>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/moment-timezone-with-data.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/fontawesome-free-6.1.1-web.all.min.js') }}"></script>
    <script src="{{ asset('js/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>

    <script>
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      const role = "<?php echo Session::get('role')?>";

      const setParams = (key, value) => {
        if ('URLSearchParams' in window) {
          const searchParams = new URLSearchParams(window.location.search);
          searchParams.set(key, value);
          window.location.search = searchParams.toString();
        }
      }

      const getParams = (key) => {
        if ('URLSearchParams' in window) {
          const searchParams = new URLSearchParams(window.location.search);
          return searchParams.get(key);
        }
      }

      const generateSelect = (elemId, data, abbreviation = true, abbreviationOnly = false) => {
        $(elemId).empty()

        $(elemId).append('<option disabled selected value>Please select ...</option')
        data.map(item => {
          if (abbreviation) {
            if (abbreviationOnly) {
              $(elemId).append(`<option value="${item.id}">${item.abbreviation}</option>`)
            } else {
              $(elemId).append(`<option value="${item.id}">${item.abbreviation} - ${item.name}</option>`)
            }
          } else {
            $(elemId).append(`<option value="${item.id}">${item.name}</option>`)
          }
        })
      }

      document.addEventListener('DOMContentLoaded', function () {
        const sidebarCollapse = document.querySelector('#sidebarCollapse');
        const sidebar = document.querySelector('#sidebar');
        const contentNavbar = document.querySelector('#content-navbar');

        if (window.innerWidth < 576) {
          sidebar.classList.add('active');
        }

        sidebarCollapse.addEventListener('click', function () {
          if (sidebar.classList.contains('active')) {
            // contentNavbar.style.width = 'calc(100% - 250px)';
            sidebar.classList.remove('active');
          } else {
            // contentNavbar.style.width = '100%';
            sidebar.classList.add('active');
          }
        });

        $('.select2').select2({
          theme: 'bootstrap-5'
        });
      })
    </script>
    @yield('script')
  </body>
</html>