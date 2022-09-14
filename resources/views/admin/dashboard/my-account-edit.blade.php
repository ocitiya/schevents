@extends('layouts.admin.master')

@section('content')
  <div id="user" class="content">
    <div class="title-container">
      <h4 class="text-primary">
        Akun Saya
      </h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <h5 class="text-primary">
          <span>Ubah Akun Saya</span>
        </h5>
      </div>

      <div class="data-center">
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form
          action="{{ route('admin.my-account.store') }}"
          method="POST"
          autocomplete="off"
          enctype="multipart/form-data"
          class="form-container row"
        >
          {{ csrf_field() }}

          <input type="hidden" name="id" value="{{ isset($data) ? $data->id : null }}">

          <div class="col-6">
            <div class="row">
              <div class="col-5">
                <label for="username">username *</label>
              </div>
              <div class="col-7">
                <input type="text" name="username" id="username" class="form-control" value="{{ old('username', isset($data) ? $data->username : null) }}" required>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="email">email</label>
              </div>
              <div class="col-7">
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', isset($data) ? $data->email : null) }}">
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="name">Nama *</label>
              </div>
              <div class="col-7">
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', isset($data) ? $data->name : null) }}" required>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="country">Gender *</label>
              </div>
              <div class="col-7">
                <select name="gender" id="gender" class="form-select">
                  <option disabled selected value>Please select ...</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="telephone">No. HP *</label>
              </div>
              <div class="col-7">
                <input type="text" name="telephone" id="telephone" class="form-control" value="{{ old('telephone', isset($data) ? $data->telephone : null) }}" required>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="facebook">Facebook</label>
              </div>
              <div class="col-7">
                <input type="text" name="facebook" id="facebook" class="form-control" value="{{ old('facebook', isset($data) ? $data->facebook : null) }}">
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="instagram">Instagram</label>
              </div>
              <div class="col-7">
                <input type="text" name="instagram" id="instagram" class="form-control" value="{{ old('instagram', isset($data) ? $data->instagram : null) }}">
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="twitter">Twitter</label>
              </div>
              <div class="col-7">
                <input type="text" name="twitter" id="twitter" class="form-control" value="{{ old('twitter', isset($data) ? $data->twitter : null) }}">
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="address">Alamat *</label>
              </div>
              <div class="col-7">
                <textarea class="form-control" name="address" id="address" required>{{ old('address', isset($data) ? $data->address : null) }}</textarea>
              </div>
            </div>

            @if (isset($data))
              <div class="row">
                <div class="col-5"></div>
                <div class="col-7">
                  @if (empty($data->avatar))
                    <img src="/images/no-logo-1.png" style="width: 100%">
                  @else
                    <img src="{{"/storage/user/image/{$data->avatar}" }}" style="width: 100%">
                  @endif
                </div>
              </div>
            @endif

            <div class="row">
              <div class="col-5">
                <label for="avatar">Avatar</label>
              </div>
              <div class="col-7">
                <input type="file" name="avatar" id="avatar" class="form-control" accept=".png, .jpg">
                <div class="">
                  @if (isset($data))
                    <small>Upload again to change avatar | File type: .jpg, .png</small><br><br>
                  @else
                    <small>File type: .jpg, .png</small><br><br>
                  @endif
                </div>
              </div>
            </div>

            @if (!isset($data))
              <div class="row">
                <div class="col-5">
                  <label for="password">Password *</label>
                </div>
                <div class="col-7">
                  <input type="password" name="password" id="password" class="form-control" required>
                </div>
              </div>
            @endif

            <div class="form-button">
              <button type="submit" class="btn btn-primary btn-sm unrounded">
                Kirim&nbsp;
                <i class="fa-solid fa-paper-plane"></i>
              </button>
            </div>
          </div>
        </form>
        
        <small class="text-red">*) Harus diisi</small>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    const levelSelected = "<?php echo old('level', isset($data) ? $data->level : null) ?>";
    const genderSelected = "<?php echo old('gender', isset($data) ? $data->gender : null) ?>";

    let is_create = "<?php echo !isset($data) ? 1 : 0 ?>"
    is_create = !!parseInt(is_create)

    const getList = (endpoint) => {
      return new Promise((resolve, reject) => {
        fetch(endpoint)
          .then(res => res.json())
          .then(data => {
            if (data.status) {
              resolve(data.data.list)
            } else {
              alert(data.message)
              reject()
            }
          })
      })
    }

    document.addEventListener('DOMContentLoaded', async function () {
      $('#level').val(levelSelected).change()
      $('#gender').val(genderSelected).change()

      if (!is_create) $('#submit').removeClass('disabled')

      let validationTimeout
      $('#name').on('keyup', function () {
        const val = $(this).val()

        if (validationTimeout) clearTimeout(validationTimeout)
        validationTimeout = setTimeout(() => {
          const formData = new FormData()
          formData.append('username', val)

          fetch(`/api/user/validate`, {
            method: 'POST',
            body: formData
          })
            .then((response) => response.json())
            .then((data) => {
              if (data.data) {
                $(this).addClass('is-valid')
                $(this).removeClass('is-invalid')

                $('#submit').removeClass('disabled')
              } else {
                $(this).addClass('is-invalid') 
                $(this).removeClass('is-valid')
              
                $('#submit').addClass('disabled')
              }
            })
        }, 1000);
      })
    })
  </script>
@endsection