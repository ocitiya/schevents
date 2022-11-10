@extends('layouts.admin.master')

@section('content')
  <div id="event" class="content">
    <div class="title-container">
      <h4 class="text-primary">Event</h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item" aria-current="page">
            <a href="{{ route('admin.masterdata.event.index') }}">Index</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Form</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <h5 class="text-primary">
          @if(!isset($data))
            <span>Tambah Event</span>
          @else
            <span>Ubah Event {{ $data->name }}</span>
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
          action="{{ route('admin.masterdata.event.store') }}"
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
                <label for="name">Nama Event *</label>
              </div>
              <div class="col-7">
                <input type="text" id="name" name="name" class="form-control capitalize" required
                  value="{{ old('name', isset($data) ? $data->name : null) }}"
                >
                <div class="invalid-feedback">
                  Event sudah terdaftar
                </div>
                <div class="valid-feedback">
                  Event bisa didaftarkan
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="start_date">Tanggal Awal Event *</label>
              </div>
              <div class="col-7">
                <input required type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', isset($data) ? $data->start_date : null) }}">
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="end_date">Tanggal Akhir Event *</label>
              </div>
              <div class="col-7">
                <input required type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', isset($data) ? $data->end_date : null) }}">
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="link">Link *</label>
              </div>
              <div class="col-7">
                <input required type="url" name="link" id="link" class="form-control" value="{{ old('link', isset($data) ? $data->link : null) }}">
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="link">Deskripsi</label>
              </div>
              <div class="col-7">
                <textarea name="description" id="description" class="form-control">{{ old('description', isset($data) ? $data->description : null) }}</textarea>
              </div>
            </div>

            @if (isset($data))
              <div class="row">
                <div class="col-5"></div>
                <div class="col-7">
                  @if (empty($data->image))
                    <img src="/images/no-logo-1.png" style="width: 100%">
                  @else
                    <img src="{{"/storage/event/image/{$data->image}" }}" style="width: 100%">
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
                    <small>Masukkan gambar untuk mengganti gambar | File type: .jpg, .png</small><br><br>
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
    let is_create = "<?php echo !isset($data) ? 1 : 0 ?>"
    is_create = !!parseInt(is_create)

    document.addEventListener('DOMContentLoaded', async function () {
      if (!is_create) $('#submit').removeClass('disabled')

      let validationTimeout
      $('#name').on('keyup', function () {
        const val = $(this).val()

        if (validationTimeout) clearTimeout(validationTimeout)
        validationTimeout = setTimeout(() => {
          const formData = new FormData()
          formData.append('name', val)

          fetch(`/api/event/validate`, {
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