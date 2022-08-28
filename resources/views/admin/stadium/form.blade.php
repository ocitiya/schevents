@extends('layouts.admin.master')

@section('content')
  <div id="stadium" class="content">
    <div class="title-container">
      <h4 class="text-primary">Lapangan / Stadion</h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item" aria-current="page">
            <a href="{{ route('admin.masterdata.stadium.index') }}">Index</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Form</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <h5 class="text-primary">
          @if(!isset($data))
            <span>Tambah Lapangan / Stadion</span>
          @else
            <span>Ubah {{ $data->name }}</span>
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
          action="{{ route('admin.masterdata.stadium.store') }}"
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
                <label for="name">Nama Lapangan / Stadion *</label>
              </div>
              <div class="col-7">
                <input type="text" id="name" name="name" class="form-control capitalize"
                  value="{{ old('name', isset($data) ? $data->name : null) }}"
                >
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="county_id">State *</label>
              </div>
              <div class="col-7">
                <select name="county_id" class="form-select" id="county_id">
                  {{-- Dynamic Data --}}
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="muuncipality_id">Kota *</label>
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
                <label for="nickname">Nickname</label>
              </div>
              <div class="col-7">
                <input type="text" id="nickname" name="nickname" class="form-control capitalize"
                  value="{{ old('nickname', isset($data) ? $data->nickname : null) }}"
                >
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="address">Alamat</label>
              </div>
              <div class="col-7">
                <textarea id="address" class="form-control" name="address">{{ old('address', isset($data) ? $data->address : null) }}</textarea>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="owner">Pemilik</label>
              </div>
              <div class="col-7">
                <input type="text" id="owner" name="owner" class="form-control capitalize"
                  value="{{ old('owner', isset($data) ? $data->owner : null) }}"
                >
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="capacity">Kapasitas</label>
              </div>
              <div class="col-7">
                <input type="text" id="capacity" name="capacity" class="form-control capitalize"
                  value="{{ old('capacity', isset($data) ? $data->capacity : null) }}"
                >
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="surface">Permukaan</label>
              </div>
              <div class="col-7">
                <input type="text" id="surface" name="surface" class="form-control capitalize"
                  value="{{ old('surface', isset($data) ? $data->surface : null) }}"
                >
              </div>
            </div>

            @if (isset($data))
              <div class="row">
                <div class="col-5"></div>
                <div class="col-7">
                  @if (empty($data->image))
                    <img src="/images/no-logo-1.png" style="width: 100%">
                  @else
                    <img src="{{"/storage/stadium/image/{$data->image}" }}" style="width: 100%">
                  @endif
                </div>
              </div>
            @endif

            <div class="row">
              <div class="col-5">
                <label for="image">Gambar</label>
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
    let stateSelected = "<?php echo old('county_id', isset($data) ? $data->county_id : null) ?>";
    let citySelected = "<?php echo old('municipality_id', isset($data) ? $data->municipality_id : null) ?>";

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
      const countries = await getList('/api/country/list')
      const country = countries[0]

      $('#county_id').on('change', async function () {
        const val = $(this).val()
        if (val !== null) {
          stateSelected = val

          const municipalities = await getList(`/api/municipality/list?state_id=${stateSelected}&showall=true`)
          generateSelect('#municipality_id', municipalities, false)
          $('#municipality_id').val(citySelected).change()
        }
      })

      const cities = await getList(`/api/county/list?country_id=${country.id}`)
      generateSelect('#county_id', cities)
      $('#county_id').val(stateSelected).change()
    })
  </script>
@endsection
