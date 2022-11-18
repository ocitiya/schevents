@extends('layouts.admin.master')

@section('content')
  <div id="channel" class="content">
    <div class="title-container">
      <h4 class="text-primary">Channel</h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item" aria-current="page">
            <a href="{{ route('admin.offer.masterdata.channel.index') }}">Index</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Form</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <h5 class="text-primary">
          @if(!isset($data))
            <span>Tambah Channel</span>
          @else
            <span>Ubah Channel {{ $data->name }}</span>
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
          action="{{ route('admin.offer.masterdata.channel.store') }}"
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
                <label for="name">Nama Channel *</label>
              </div>
              <div class="col-7">
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name', isset($data) ? $data->name : null) }}">
                <div class="invalid-feedback">
                  Channel sudah terdaftar
                </div>
                <div class="valid-feedback">
                  Channel bisa didaftarkan
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="code">Code *</label>
              </div>
              <div class="col-7">
                <input type="text" class="form-control" name="code" id="code" value="{{ old('code', isset($data) ? $data->code : null) }}">
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="user_id">User *</label>
              </div>
              <div class="col-7">
                <select name="user_id" class="form-select select2" id="user_id" required>
                  <option disabled selected value>Please select ...</option>
                  @foreach ($users as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                  @endforeach
                </select>
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
    
    const userSelected = "<?php echo old('user_id', isset($data) ? $data->user_id : null) ?>";

    document.addEventListener('DOMContentLoaded', async function () {
      $('#user_id').val(userSelected).change();
      if (!is_create) $('#submit').removeClass('disabled')

      let validationTimeout
      $('#name').on('keyup', function () {
        const val = $(this).val()

        if (validationTimeout) clearTimeout(validationTimeout)
        validationTimeout = setTimeout(() => {
          const formData = new FormData()
          formData.append('name', val)

          fetch(`/api/offer/channel/validate`, {
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
