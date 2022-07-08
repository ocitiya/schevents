<html>
  <head>
    <title>Web Sports - Install</title>

    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans&display=swap" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.2.0/dist/css/datepicker.min.css"> --}}
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2-bootstrap-5-theme.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
  </head>
  <body>

    <div class="bg-light" id="install">
      <div class="content">
        <div class="text-primary mb-5 text-center">
          <img src="{{ asset('images/computer.png') }}" style="max-width: 180px" />
          <h5><strong>Welcome to Web Sports App</strong></h5>
        </div>

        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <label>Please add app information below for first time use:</label>

        <form
          action="{{ route('install.store.step1') }}"
          method="POST"
          enctype="multipart/form-data"
          class="form-container mt-3"
          autocomplete="off"
        >
          {{ csrf_field() }}
          <div class="row">
            <div class="col-4">
              <label for="name">App Name *</label>
            </div>
            <div class="col-8">
              <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
            </div>
          </div>

          <div class="row">
            <div class="col-4">
              <label for="name">App Logo *</label>
            </div>
            <div class="col-8">
              <input type="file" name="logo" id="logo" class="form-control" accept=".png, .jpg">
              <div class="">
                <small>File type: .jpg, .png | </small>
                <small>Max: 512 KB</small>
              </div>
            </div>
          </div>

          <div class="form-button">
            <button type="submit" class="btn btn-primary unrounded">
              Continue&nbsp;
              <i class="fa-solid fa-angle-right"></i>
            </button>
          </div>
        </form>
      </div>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.2.0/dist/js/datepicker-full.min.js"></script> --}}
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/fontawesome-free-6.1.1-web.all.min.js') }}"></script>
    <script src="{{ asset('js/daterangepicker.js') }}"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {

      })
    </script>
  
  </body>
</html>