@extends('layouts.admin.master')

@section('content')
  <div id="counties" class="content">
    <div class="title-container">
      <h4 class="text-primary">State</h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item" aria-current="page">
            <a href="{{ route('admin.location.counties.index') }}">Index</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Form</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <h5 class="text-primary">
          @if(!isset($data))
            <span>Tambah State Baru</span>
          @else
            <span>Ubah State {{ $data->name }}</span>
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
          action="{{ route('admin.location.counties.store') }}"
          method="POST"
          autocomplete="off"
          class="form-container row"
          enctype="multipart/form-data"
        >
          {{ csrf_field() }}

          <input type="hidden" name="id" value="{{ isset($data) ? $data->id : null }}">

          <div class="col-6">
            <div class="row">
              <div class="col-5">
                <label for="name">Nama State *</label>
              </div>
              <div class="col-7">
                <input type="text" id="name" name="name" class="form-control capitalize"
                  value="{{ old('name', isset($data) ? $data->name : null) }}"
                >
                <div class="invalid-feedback">
                  State sudah terdaftar
                </div>
                <div class="valid-feedback">
                  State bisa didaftarkan
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="abbreviation">Singkatan *</label>
              </div>
              <div class="col-7">
                <input type="text" id="abbreviation" name="abbreviation" class="form-control capitalize"
                  value="{{ old('abbreviation', isset($data) ? $data->abbreviation : null) }}"
                >
              </div>
            </div>

            @if (isset($data) && !empty($data->logo))
              <div class="row">
                <div class="col-5"></div>
                <div class="col-7">
                  <img src="{{"/storage/counties/logo/{$data->logo}" }}" style="width: 100%">
                </div>
              </div>
            @endif

            <div class="row">
              <div class="col-5">
                <label for="logo">Logo</label>
              </div>
              <div class="col-7">
                <input type="file" name="logo" id="logo" class="form-control" accept=".png, .jpg">
                <div class="">
                  @if (isset($data))
                    <small>Upload again to change logo | File type: .jpg, .png</small><br><br>
                  @else
                    <small>File type: .jpg, .png</small><br><br>
                  @endif
                </div>
              </div>
            </div>

            <div class="form-button">
              <button id="submit" type="submit" class="btn btn-primary btn-sm unrounded disabled">
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

<script>
  let is_create = "<?php echo !isset($data) ? 1 : 0 ?>"
  is_create = !!parseInt(is_create)

  document.addEventListener('DOMContentLoaded', function () {
    if (!is_create) $('#submit').removeClass('disabled')

    const nameValidate = (elem, state) => {
      if (!state) {
        $(elem).addClass('is-invalid') 
        $(elem).removeClass('is-valid')
      
        $('#submit').addClass('disabled')
      } else {
        $(elem).addClass('is-valid')
        $(elem).removeClass('is-invalid')

        $('#submit').removeClass('disabled')
      }
    }

    let validationTimeout
    $('#name').on('keyup', function () {
      const val = $(this).val()

      if (validationTimeout) clearTimeout(validationTimeout)
      validationTimeout = setTimeout(() => {
        const formData = new FormData()
        formData.append('county', val)

        fetch(`/api/county/validate`, {
          method: 'POST',
          body: formData
        })
          .then((response) => response.json())
          .then((data) => {
            if (data.data) {
              nameValidate(this, true)
            } else {
              nameValidate(this, false)
            }
          })
      }, 1000);
    })
  })
</script>