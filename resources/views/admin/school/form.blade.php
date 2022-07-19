@extends('layouts.admin.master')

@section('content')
  <div id="sport_type" class="content">
    <div class="title-container">
      <h4 class="text-primary">Sekolah</h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item" aria-current="page">
            <a href="{{ route('admin.sport.type.index') }}">Index</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Form</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <h5 class="text-primary">
          @if(!isset($data))
            <span>Tambah Sekolah Baru</span>
          @else
            <span>Ubah Sekolah {{ $data->name }}</span>
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
          action="{{ route('admin.school.store') }}"
          method="POST"
          autocomplete="off"
          class="form-container row"
          enctype="multipart/form-data"
        >
          {{ csrf_field() }}

          <input type="hidden" name="id" value="{{ isset($data) ? $data->id : null }}">
          <input type="hidden" name="redirect_city" value="{{ $default_city != null ? 1 : 0 }}">

          <div class="col-7">
            <div class="row">
              <div class="col-5">
                <label for="name">Nama Sekolah *</label>
              </div>
              <div class="col-7">
                <input type="text" id="name" name="name" class="form-control capitalize"
                  value="{{ old('name', isset($data) ? $data->name : null) }}"
                >
                <div class="invalid-feedback">
                  Sekolah sudah terdaftar
                </div>
                <div class="valid-feedback">
                  Sekolah bisa didaftarkan
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="name">Kota *</label>
              </div>
              <div class="col-7">
                @if ($default_city != null)
                  <input type="hidden" name="county_id" value="{{ $default_city }}"/>
                  <select class="form-select" id="county_id" disabled>
                    {{-- Dynamic Data --}}
                  </select>
                @else
                  <select name="county_id" class="form-select select2" id="county_id">
                    {{-- Dynamic Data --}}
                  </select>
                @endif
              </div>
            </div>

            @if (isset($data))
              <div class="row">
                <div class="col-5"></div>
                <div class="col-7">
                  <img src="{{"/storage/school/logo/{$data->logo}" }}" style="width: 100%">
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

@section('script')
  <script>
    const countySelected = "<?php echo old('county_id', isset($data) ? $data->county_id : $default_city) ?>";
    const cityDefault = "<?php echo $default_city ? 1 : 0 ?>"

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

    const generateSelect = (elemId, data) => {
      $(elemId).empty()

      $(elemId).append('<option disabled selected value>Please select ...</option')
      data.map(item => {
        $(elemId).append(`<option value="${item.id}">${item.name} - ${item.abbreviation}</option>`)
      })
    }

    document.addEventListener('DOMContentLoaded', async function () {
      const countries = await getList('/api/country/list')
      const country = countries[0]

      const cities = await getList(`/api/county/list?country_id=${country.id}&showall=true`)
      generateSelect('#county_id', cities)
      $('#county_id').val(countySelected).change()
      if (cityDefault == 1) $('#county_id').prop('disabled', true)

      let validationTimeout
      $('#name').on('keyup', function () {
        const val = $(this).val()

        if (validationTimeout) clearTimeout(validationTimeout)
        validationTimeout = setTimeout(() => {
          const formData = new FormData()
          formData.append('school', val)

          fetch(`/api/school/validate`, {
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
