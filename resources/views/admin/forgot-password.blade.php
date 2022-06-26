<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title>Admin Dashboard - Login</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
  <link href="{{ asset('css/admin/main.css') }}" rel="stylesheet">
</head>
<body>
  <div id="login" class="align-items-center d-flex justify-content-center">
    <div class="card-wrapper">
      <div class="card shadow rounded">
        <div class="card-body p-5">
          <div class="text-center mb-5 display-6 text-primary">
            <i class="fa-solid fa-question"></i>
            Forgot Password
          </div>

          <form
            action="{{ route('admin.login.auth') }}"
            method="POST"
            class="my-login-validation"
          >
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input id="email" type="email" class="form-control" name="email" value="" required autofocus>
              <small>
                By clicking "Reset Password" we will send a password reset link
              </small>
            </div>

            <div class="mb-4 text-end">
              <a href="{{ route('admin.login') }}">Back to Login</a>
            </div>
  
            <div class="d-grid gap-2">
              <button class="btn btn-primary" type="submit">Reset Password</button>
            </div>
          </form>
        </div>
      </div>
  
      <div class="footer mt-5 text-center">
        <figcaption class="blockquote-footer">
          Copyright &copy; 2022
        </figcaption>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  <script src="{{ asset('js/fontawesome-free-6.1.1-web.all.min.js') }}"></script>
</body>
</html>
