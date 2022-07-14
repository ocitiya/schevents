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

          <div class="col-7">
            <div class="row">
              <div class="col-5">
                <label for="name">Nama Sekolah *</label>
              </div>
              <div class="col-7">
                <input type="text" id="name" name="name" class="form-control capitalize"
                  value="{{ old('name', isset($data) ? $data->name : null) }}"
                >
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="name">Kota *</label>
              </div>
              <div class="col-7">
                <select name="county_id" class="form-select" id="county_id">
                  {{-- Dynamic Data --}}
                </select>
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
                <label for="logo">Logo *</label>
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

            <div class="row">
              <div class="col-5">
                <label for="name">Tingkat Sekolah *</label>
              </div>
              <div class="col-7">
                <select name="level_of_education" class="form-select" id="level_of_education">
                  <option disabled selected value>Please select ...</option>
                  <option value="kindergarden">Kindergarden</option>
                  <option value="elementary school">Elementary School</option>
                  <option value="junior high school">Junior High School</option>
                  <option value="senior high school">Senior High School</option>
                  <option value="vocational school">Vocational School</option>
                  <option value="university">University</option>
                  <option value="college">College</option>
                </select>
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
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    const countySelected = "<?php echo old('county_id', isset($data) ? $data->county_id : $default_city) ?>";
    const levelOfEducationSelected = "<?php echo old('level_of_education', isset($data) ? $data->level_of_education : null) ?>";

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
        $(elemId).append(`<option value="${item.id}">${item.name}</option>`)
      })
    }

    document.addEventListener('DOMContentLoaded', async function () {
      const countries = await getList('/api/country/list')
      const country = countries[0]

      const cities = await getList(`/api/county/list?country_id=${country.id}`)
      generateSelect('#county_id', cities)
      $('#county_id').val(countySelected).change()

      $('#level_of_education').val(levelOfEducationSelected).change()
    })
  </script>
@endsection
