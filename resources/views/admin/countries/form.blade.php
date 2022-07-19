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
                <input type="text" id="name" name="name" class="form-control"
                  value="{{ old('name', isset($data) ? $data->name : null) }}"
                >
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="alpha2_code">Kode Negara *</label>
              </div>
              <div class="col-7">
                <input type="text" id="alpha2_code" name="alpha2_code" class="form-control"
                  value="{{ old('alpha2_code', isset($data) ? $data->alpha2_code : null) }}"
                >
                <div class="text-secondary">
                  <small>Gunakan dua karakter kode negara.</small><br/>
                  <small>ISO 3166-1 alpha-2</small>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="dial_code">Kode Telepon *</label>
              </div>
              <div class="col-7">
                <input type="text" id="dial_code" name="dial_code" class="form-control"
                  value="{{ old('dial_code', isset($data) ? $data->dial_code : null) }}"
                >
                <div class="text-secondary">
                  <small>Ex. +62</small><br/>
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
