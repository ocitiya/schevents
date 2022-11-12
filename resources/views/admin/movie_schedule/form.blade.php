@extends('layouts.admin.master')

@section('content')
  <div id="event" class="content">
    <div class="title-container">
      <h4 class="text-primary">Jadwal Film</h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item" aria-current="page">
            <a href="{{ route('admin.movie.schedule.index') }}">Index</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Form</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <h5 class="text-primary">
          @if(!isset($data))
            <span>Tambah Jadwal Film</span>
          @else
            <span>Ubah Jadwal Film {{ $data->name }}</span>
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
          action="{{ route('admin.movie.schedule.store') }}"
          method="POST"
          autocomplete="off"
          enctype="multipart/form-data"
          class="form-container row"
        >
          {{ csrf_field() }}

          <input type="hidden" name="id" value="{{ isset($data) ? $data->id : null }}">

          <div class="col-8">
            <div class="row">
              <div class="col-5">
                <label for="name">Nama Film *</label>
              </div>
              <div class="col-7">
                <select name="movie_id" class="form-select select2" id="movie_id" required>
                  <option disabled selected value>Please select ...</option>
                  @foreach ($movies as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="show_date">Tanggal Tayang *</label>
              </div>
              <div class="col-7">
                <input required type="date" name="show_date" id="show_date" class="form-control" value="{{ old('show_date', isset($data) ? $data->show_date : null) }}">
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="link">Link *</label>
              </div>
              <div class="col-7">
                <input required type="text" name="link" id="link" class="form-control" value="{{ old('link', isset($data) ? $data->link : null) }}">
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
    const movieSelected = "<?php echo old('movie_id', isset($data) ? $data->movie_id : null) ?>";

    document.addEventListener('DOMContentLoaded', async function () {
      $('#movie_id').val(movieSelected).change();
    });
  </script>
@endsection
