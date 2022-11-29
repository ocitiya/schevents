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
            <span>Tambah Tim Baru</span>
          @else
            <span>Ubah Tim {{ $data->name }}</span>
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
                <label for="name">Nama Tim *</label>
              </div>
              <div class="col-7">
                <input type="text" id="name" name="name" class="form-control capitalize"
                  value="{{ old('name', isset($data) ? $data->name : null) }}"
                >
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="nickname">Julukan</label>
              </div>
              <div class="col-7">
                <input type="text" id="nickname" name="nickname" class="form-control capitalize"
                  value="{{ old('nickname', isset($data) ? $data->nickname : null) }}"
                >
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
                  <option disabled selected value>Pilih Federasi Dulu</option>
                  {{-- Dynamic Data --}}
                </select>
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

            @if (isset($data))
              <div class="row">
                <div class="col-5"></div>
                <div class="col-7">
                  @if (empty($data->logo))
                    <img src="/images/no-logo-1.png" style="width: 100%">
                  @else
                    <img src="{{ "/storage/school/logo/{$data->logo}" }}" style="width: 100%">
                  @endif
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
    let stateSelected = "<?php echo old('county_id', isset($data) ? $data->county_id : $default_state) ?>";
    let citySelected = "<?php echo old('municipality_id', isset($data) ? $data->municipality_id : $default_city) ?>";
    let countrySelected = "<?php echo old('country_id', isset($data) ? $data->country_id : $default_country) ?>";
    
    const federationSelected = "<?php echo old('federation_id', isset($data) ? $data->federation_id : null) ?>";
    const associationSelected = "<?php echo old('association_id', isset($data) ? $data->association_id : null) ?>";
    const cityDefault = "<?php echo $default_city ? 1 : 0 ?>";

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

      if (cityDefault == 1) {
        $('#country_id').prop('disabled', true);
        $(`<input type="hidden" name="country_id" value="${countrySelected}" />`).insertBefore('#country_id');
        
        $('#county_id').prop('disabled', true);
        $(`<input type="hidden" name="county_id" value="${stateSelected}" />`).insertBefore('#county_id');
      
        $('#municipality_id').prop('disabled', true);
        $(`<input type="hidden" name="municipality_id" value="${citySelected}" />`).insertBefore('#municipality_id');
      }

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
          generateSelect('#association_id', associations, true);
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
      if (!is_create) {
        $('#federation_id').val(federationSelected).change();
      }

      if (cityDefault == 1) $('input[name=county_id').val(stateSelected);
    });
  </script>
@endsection
