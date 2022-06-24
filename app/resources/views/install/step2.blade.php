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
          <img src="{{ asset('images/register.png') }}" style="max-width: 180px" />
        </div>
        <label>Next, add system admin information below:</label>
        <form autocomplete="off" method="POST" class="form-container mt-3">
          <div class="row">
            <div class="col-4">
              <label for="name">Name</label>
            </div>
            <div class="col-8">
              <input type="text" name="name" id="name" class="form-control">
            </div>
          </div>

          <div class="row">
            <div class="col-4">
              <label for="email">Email</label>
            </div>
            <div class="col-8">
              <input type="email" name="email" id="email" class="form-control">
            </div>
          </div>

          <div class="row">
            <div class="col-4">
              <label for="password">Password</label>
            </div>
            <div class="col-8">
              <input type="password" name="password" id="password" class="form-control">
            </div>
          </div>

          <div class="row">
            <div class="col-4">
              <label for="c_password">Password Confirmation</label>
            </div>
            <div class="col-8">
              <input type="c_password" name="c_password" id="c_password" class="form-control">
            </div>
          </div>

          <div class="row">
            <div class="col-4">
              <label for="country">Country</label>
            </div>
            <div class="col-8">
              <select name="country" id="country" class="form-select">
                {{-- Dynamic Data --}}
              </select>
            </div>
          </div>

          <div class="row">
            <div class="col-4">
              <label for="telephone">Telephone</label>
            </div>
            <div class="col-8">
              <div class="input-group mb-3">
                <span class="input-group-text" id="telephone-addon">
                  {{-- Dynamic Data --}}
                </span>
                <input type="text" name="telephone" id="telephone" class="form-control" aria-describedby="telephone-addon">
              </div>
            </div>
          </div>

          <div class="form-button">
            <button type="submit" class="btn btn-primary unrounded">
              Finish&nbsp;
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
      countries = []

      document.addEventListener('DOMContentLoaded', async () => {
        $('#country').empty()

        const _countries = await getCountries()
        countries = _countries.slice()
        _countries.map(item => {
          if (item.name === '') {
            $('#country').append(`<option disabled selected value>Please select ....</option>`)
          } else {
            $('#country').append(`<option value="${item.name}">${item.name}</option>`)
          }
        })

        $('#country').on('change', function () {
          const country = countries.find(item => item.name === $(this).val())
          $('#telephone-addon').text(country.dial_code)
        })
      })

      const getCountries = () => {
        const url = "<?php echo asset('dataset/countries.json') ?>"
        
        return new Promise(resolve => {
          fetch(url).then(res => res.json()).then(data => resolve(data))
        })
      }
    </script>
  
  </body>
</html>