@extends('layouts.admin.master')

@section('content')
  <div id="socmed" class="content">
    <div class="title-container">
      <h4 class="text-primary">Akun Sosmed</h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item" aria-current="page">
            <a href="{{ route('admin.masterdata.socmed.index') }}">Index</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Form</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <h5 class="text-primary">
          @if(!isset($data))
            <span>Tambah Sosmed</span>
          @else
            <span>Ubah Sosmed {{ $data->name }}</span>
          @endisset
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
          action="{{ route('admin.masterdata.socmed-account.store') }}"
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
                <label for="socmed_id">Sosmed *</label>
              </div>
              <div class="col-7">
                <select name="socmed_id" class="form-select select2" id="socmed_id">
                  {{-- Dynamic Data --}}
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="federation_id">Federasi *</label>
              </div>
              <div class="col-7">
                <select name="federation_id" class="form-select select2" id="federation_id">
                  {{-- Dynamic Data --}}
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="account_profile">Nama Profil *</label>
              </div>
              <div class="col-7">
                <input type="text" name="account_profile" id="account_profile" class="form-control" value="{{ old('account_profile', isset($data) ? $data->account_profile : null) }}" required>
              </div>
            </div>

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
                <label for="account_profile">email</label>
              </div>
              <div class="col-7">
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', isset($data) ? $data->email : null) }}">
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="phone">No. HP</label>
              </div>
              <div class="col-7">
                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', isset($data) ? $data->phone : null) }}">
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="password">password *</label>
              </div>
              <div class="col-7">
                <input type="text" name="password" id="password" class="form-control" value="{{ old('password', isset($data) ? $data->password : null) }}" required>
              </div>
            </div>

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
    const socmedSelected = "<?php echo old('socmed_id', isset($data) ? $data->socmed_id : null) ?>";
    const federationSelected = "<?php echo old('federation_id', isset($data) ? $data->federation_id : null) ?>";

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
      const socmed = await getList(`/api/socmed/list?showall=true`)
      generateSelect('#socmed_id', socmed, false)
      $('#socmed_id').val(socmedSelected).change()

      const federation = await getList(`/api/federation/list?showall=true`)
      generateSelect('#federation_id', federation, true, true)
      $('#federation_id').val(federationSelected).change()

      if (!is_create) $('#submit').removeClass('disabled')

      let validationTimeout
      $('#name').on('keyup', function () {
        const val = $(this).val()

        if (validationTimeout) clearTimeout(validationTimeout)
        validationTimeout = setTimeout(() => {
          const formData = new FormData()
          formData.append('name', val)

          fetch(`/api/socmed_account/validate`, {
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