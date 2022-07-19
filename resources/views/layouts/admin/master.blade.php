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

            <div>
              <div class="btn btn-light text-black-75">
                <i class="fa-solid fa-user"></i>
              </div>

              <a href="{{ route('admin.logout') }}" class="btn btn-danger">
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

      document.addEventListener('DOMContentLoaded', function () {
        const sidebarCollapse = document.querySelector('#sidebarCollapse')
        const sidebar = document.querySelector('#sidebar')

        sidebarCollapse.addEventListener('click', function () {
          sidebar.classList.toggle('active')
        })

        $('.select2').select2({
          theme: 'bootstrap-5'
        });
      })
    </script>
    @yield('script')
  </body>
</html>