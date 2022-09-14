@extends('layouts.admin.master')

@section('content')
  <div id="user" class="content">
    <div class="title-container">
      <h4 class="text-primary">
        Rubah Password
      </h4>
    </div>

    <div class="data-container">
      <div class="data-header">
        <h5 class="text-primary">
          <span>Rubah Password</span>
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
          action="{{ route('admin.update-password') }}"
          method="POST"
          autocomplete="off"
          enctype="multipart/form-data"
          class="form-container row"
        >
          {{ csrf_field() }}

          <div class="col-8">
            <div class="row mb-3">
              <div class="col-5">
                <label for="password">Password Lama *</label>
              </div>
              <div class="col-7">
                <input type="password" name="old_password" id="old_password" class="form-control">
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-5">
                <label for="password">Password *</label>
              </div>
              <div class="col-7">
                <input type="password" name="password" id="password" class="form-control">
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-5">
                <label for="password_confirmation">Konfirmasi Password *</label>
              </div>
              <div class="col-7">
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
              </div>
            </div>

            <div class="form-button">
              <button type="submit" class="btn btn-primary btn-sm unrounded">
                Simpan&nbsp;
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