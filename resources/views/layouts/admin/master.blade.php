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
              <div class="btn btn-light text-black-75">
                <i class="fa-solid fa-user"></i>
              </div>

              <div class="btn btn-danger">
                <i class="fa-solid fa-right-from-bracket"></i>
              </div>
            </div>
          </div>
        </nav>

        @yield('content')
      </div>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/fontawesome-free-6.1.1-web.all.min.js') }}"></script>
    <script src="{{ asset('js/daterangepicker.js') }}"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarCollapse = document.querySelector('#sidebarCollapse')
        const sidebar = document.querySelector('#sidebar')

        sidebarCollapse.addEventListener('click', function () {
          sidebar.classList.toggle('active')
        })
      })
    </script>
  </body>
</html>