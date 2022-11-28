@extends('layouts.admin.master')

@section('content')
  <div id="championship" class="content">
    <div class="title-container">
      <h4 class="text-primary">Kejuaraan</h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item" aria-current="page">
            <a href="{{ route('admin.masterdata.championship.index') }}">Index</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Form</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <h5 class="text-primary">
          @if(!isset($data))
            <span>Tambah Kejuaraan</span>
          @else
            <span>Ubah Kejuaraan {{ $data->name }}</span>
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
          action="{{ route('admin.masterdata.championship.store') }}"
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
                <label for="name">Nama Kejuaraan *</label>
              </div>
              <div class="col-7">
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name', isset($data) ? $data->name : null) }}">
                <div class="invalid-feedback">
                  Nama sudah terdaftar
                </div>
                <div class="valid-feedback">
                  Nama bisa didaftarkan
                </div>
              </div>
            </div>

            @if (isset($data))
              <div class="row">
                <div class="col-5"></div>
                <div class="col-7">
                  <img src="{{"/storage/championship/image/{$data->image}" }}" style="width: 100%">
                </div>
              </div>
            @endif

            <div class="row">
              <div class="col-5">
                <label for="image">Logo</label>
              </div>
              <div class="col-7">
                <input type="file" name="image" id="image" class="form-control" accept=".png, .jpg">
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

        fetch(`/api/championship/validate`, {
          method: 'POST',
          body: formData
        })
          .then((response) => response.json())
          .then((data) => {
            if (data.status) {
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
