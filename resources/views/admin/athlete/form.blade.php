@extends('layouts.admin.master')

@section('content')
  <div id="sport_type" class="content">
    <div class="title-container">
      <h4 class="text-primary">Tim</h4>

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
            <span>Tambah Atlit Baru</span>
          @else
            <span>Ubah Atlit {{ $data->name }}</span>
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
          action="{{ route('admin.masterdata.athlete.store') }}"
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
                <label for="name">Nama *</label>
              </div>
              <div class="col-7">
                <input type="text" id="name" name="name" class="form-control capitalize" required
                  value="{{ old('name', isset($data) ? $data->name : null) }}"
                >
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="gender">Jenis Kelamin *</label>
              </div>
              <div class="col-7">
                <select id="gender" name="gender" class="form-control" required>
                  <option disabled selected value>Silahkan pilih ...</option>
                  <option value="male">Laki laki</option>
                  <option value="female">Perempuan</option>
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="date_of_birth">Tanggal Lahir</label>
              </div>
              <div class="col-7">
                <input type="date" id="date_of_birth" name="date_of_birth" class="form-control"
                  value="{{ old('date_of_birth', isset($data) ? $data->date_of_birth : null) }}"
                >
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="height">Tinggi Badan</label>
              </div>
              <div class="col-7">
                <div class="input-group">
                  <input type="number" id="height" name="height" class="form-control capitalize"
                    value="{{ old('height', isset($data) ? $data->height : null) }}"
                  >
                  <span class="input-group-text" id="basic-addon2">cm</span>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="weight">Berat Badan</label>
              </div>
              <div class="col-7">
                <div class="input-group">
                  <input type="number" id="weight" name="weight" class="form-control capitalize"
                    value="{{ old('weight', isset($data) ? $data->weight : null) }}"
                  >
                  <span class="input-group-text" id="basic-addon2">kg</span>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="nickname">Nama Panggilan</label>
              </div>
              <div class="col-7">
                <input type="text" id="nickname" name="nickname" class="form-control capitalize"
                  value="{{ old('nickname', isset($data) ? $data->nickname : null) }}"
                >
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="surname">Julukan</label>
              </div>
              <div class="col-7">
                <input type="text" id="surname" name="surname" class="form-control capitalize"
                  value="{{ old('surname', isset($data) ? $data->surname : null) }}"
                >
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="name">Negara *</label>
              </div>
              <div class="col-7">
                <select name="country_id" class="select2 form-select" id="country_id">
                  <option disabled selected value>Please select ...</option>
                  @foreach ($countries as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="row" id="state-container" style="display: none">
              <div class="col-5">
                <label for="name">State</label>
              </div>
              <div class="col-7">
                <select name="county_id" class="form-select select2" id="county_id">
                  <option disabled selected value>Silahkan pilih ...</option>
                  {{-- Dynamic Data --}}
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="name">Kota</label>
              </div>
              <div class="col-7">
                <select name="municipality_id" class="form-select select2" id="municipality_id">
                  <option disabled selected value>Pilih State Dulu</option>
                  {{-- Dynamic Data --}}
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="wingspan">Lebar Sayap</label>
              </div>
              <div class="col-7">
                <input type="number" id="wingspan" name="wingspan" class="form-control capitalize"
                  value="{{ old('wingspan', isset($data) ? $data->wingspan : null) }}"
                >
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="age">Umur</label>
              </div>
              <div class="col-7">
                <div class="input-group">
                  <input type="number" id="age" name="age" class="form-control capitalize"
                    value="{{ old('age', isset($data) ? $data->age : null) }}"
                  >
                  <span class="input-group-text" id="basic-addon2">tahun</span>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="name">Federasi *</label>
              </div>
              <div class="col-7">
                <select class="form-select select2" id="federation_id" name="federation_id">
                  <option selected value>N/A</option>
                  @foreach ($federations as $item)
                    <option value="{{ $item->id }}">{{ $item->abbreviation }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="name">Asosiasi</label>
              </div>
              <div class="col-7">
                <select class="form-select select2" id="association_id" name="association_id">
                  <option selected value>Pilih Federasi Dulu</option>
                  {{-- Dynamic Data --}}
                </select>
              </div>
            </div>

            @if (isset($data))
              <div class="row">
                <div class="col-5"></div>
                <div class="col-7">
                  @if (empty($data->image))
                    <img src="/images/no-logo-1.png" style="width: 100%">
                  @else
                    <img src="{{ "/storage/athlete/image/{$data->image}" }}" style="width: 100%">
                  @endif
                </div>
              </div>
            @endif

            <div class="row">
              <div class="col-5">
                <label for="image">Foto</label>
              </div>
              <div class="col-7">
                <input type="file" name="image" id="image" class="form-control" accept=".png, .jpg">
                <div class="">
                  @if (isset($data))
                    <small>Upload again to change image | File type: .jpg, .png</small><br><br>
                  @else
                    <small>File type: .jpg, .png</small><br><br>
                  @endif
                </div>
              </div>
            </div>

            <div class="form-button">
              <button id="submit" type="submit" class="btn btn-primary btn-sm unrounded">
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
    let stateSelected = "<?php echo old('county_id', isset($data) ? $data->county_id : null) ?>";
    let citySelected = "<?php echo old('municipality_id', isset($data) ? $data->municipality_id : null) ?>";
    let countrySelected = "<?php echo old('country_id', isset($data) ? $data->country_id : null) ?>";
    let genderSelected = "<?php echo old('gender', isset($data) ? $data->gender : null) ?>";
    
    const federationSelected = "<?php echo old('federation_id', isset($data) ? $data->federation_id : null) ?>";
    const associationSelected = "<?php echo old('association_id', isset($data) ? $data->association_id : null) ?>";

    let is_error = "<?php echo $errors->any() ? 1 : 0 ?>";
    is_error = !!parseInt(is_error);

    let is_create = "<?php echo !isset($data) ? 1 : 0 ?>";
    is_create = !!parseInt(is_create);

    const getList = (endpoint) => {
      return new Promise((resolve, reject) => {
        fetch(endpoint)
          .then(res => res.json())
          .then(data => {
            if (data.status) {
              resolve(data.data.list);
            } else {
              alert(data.message);
              reject();
            }
          });
      });
    }

    document.addEventListener('DOMContentLoaded', async function () {
      if (is_error) {
        $('#submit').prop('disabled', true);
      }

      $('#country_id').on('change', async function () {
        const val = $(this).val();
        if (val == null) return false;

        loadingSelect('#county_id');
        loadingSelect('#municipality_id');

        countrySelected = val;

        await fetch(`/api/country/hasState/${val}`).then((res) => res.json())
          .then(async (data) => {
            if (!data.status) {
              $('#county_id').val('').change()
              // $('#county_id').prop('required', false);
              $('#state-container').css('display', 'none');

              const municipalities = await getList(`/api/municipality/list?country_id=${countrySelected}&showall=true`);
              generateSelect('#municipality_id', municipalities, false);
              $('#municipality_id').val(citySelected).change();
            } else {
              $('#state-container').css('display', 'flex');
              // $('#county_id').prop('required', true);
              const counties = await getList(`/api/county/list?showall=true&country_id=${val}`);
              generateSelect('#county_id', counties, false);

              $('#county_id').val(stateSelected).change();
            }
          });
      });

      $('#name').on('keyup', function () {
        if (is_error) {
          $('#submit').prop('disabled', false);
          is_error = false;
        }
      });
      
      $('#federation_id').on('change', async function () {
        const val = $(this).val();
        if (val !== null) {
          loadingSelect('#association_id');
          const associations = await getList(`/api/association/list?showall=true&federation_id=${val}`);
          generateSelect('#association_id', associations, true, false, false);
          $('#association_id').val(associationSelected).change();
        }
      });

      $('#county_id').on('change', async function () {
        const val = $(this).val();
        if (val !== null) {
          loadingSelect('#municipality_id');
          stateSelected = val;

          const municipalities = await getList(`/api/municipality/list?state_id=${stateSelected}&showall=true`);
          generateSelect('#municipality_id', municipalities, false);
          $('#municipality_id').val(citySelected).change();
          if (cityDefault == 1) $('input[name=municipality_id').val(citySelected);
        }
      });

      $('#country_id').val(countrySelected).change();
      $('#county_id').val(stateSelected).change();
      $('#gender').val(genderSelected).change();
      if (!is_create) {
        $('#federation_id').val(federationSelected).change();
      }
    });
  </script>
@endsection
