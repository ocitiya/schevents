@extends('layouts.admin.master')

@section('content')
  <div id="counties" class="content">
    <div class="title-container">
      <h4 class="text-primary">Kota</h4>

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
            <span>Tambah Kota Baru</span>
          @else
            <span>Ubah Kota {{ $data->name }}</span>
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
        >
          {{ csrf_field() }}

          <input type="hidden" name="id" value="{{ isset($data) ? $data->id : null }}">

          <div class="col-6">
            <div class="row">
              <div class="col-5">
                <label for="name">Nama Kota *</label>
              </div>
              <div class="col-7">
                <input type="text" id="name" name="name" class="form-control capitalize"
                  value="{{ old('name', isset($data) ? $data->name : null) }}"
                >
                <div class="invalid-feedback">
                  Kota sudah terdaftar
                </div>
                <div class="valid-feedback">
                  Kota bisa didaftarkan
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
  document.addEventListener('DOMContentLoaded', function () {
    const nameValidate = (elem, state) => {
      console.log(state)
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