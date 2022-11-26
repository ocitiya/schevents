@extends('layouts.admin.master')

@section('content')
  <div id="countries" class="content">
    <div class="title-container">
      <h4 class="text-primary">Negara</h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item" aria-current="page">
            <a href="{{ route('admin.location.countries.index') }}">Index</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Form</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <h5 class="text-primary">
          @if(!isset($data))
            <span>Tambah Negara Baru</span>
          @else
            <span>Ubah Negara {{ $data->name }}</span>
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
          action="{{ route('admin.location.countries.store') }}"
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
                <label for="name">Nama Negara *</label>
              </div>
              <div class="col-7">
                <input type="text" id="name" name="name" class="form-control" required
                  value="{{ old('name', isset($data) ? $data->name : null) }}"
                >
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="alpha3_code">Singkatan *</label>
              </div>
              <div class="col-7">
                <input type="text" id="alpha3_code" name="alpha3_code" class="form-control" required
                  value="{{ old('alpha3_code', isset($data) ? $data->alpha3_code : null) }}"
                >
                <div class="text-secondary">
                  <small>Gunakan tiga karakter singkatan.</small><br/>
                  {{-- <small>ISO 3166-1 alpha-2</small> --}}
                </div>
              </div>
            </div>

            @if (isset($data) && !empty($data->image))
              <div class="row">
                <div class="col-5"></div>
                <div class="col-7">
                  <img src="{{"/storage/countries/image/{$data->image}" }}" style="width: 100%">
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

            <div class="row">
              <div class="col-5">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="has_state" name="has_state">
                  <label class="form-check-label" for="has_state">
                    Punya State ?
                  </label>
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

        <small class="text-red">*) Harus diisi</small>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    const hasState = "<?php echo old('has_state', isset($data) ? $data->has_state : 0) ?>";

    document.addEventListener('DOMContentLoaded', function () {
      if (hasState == 1) { $('#has_state').prop('checked', true); }
    });
  </script>
@endsection
