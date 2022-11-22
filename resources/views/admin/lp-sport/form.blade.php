@extends('layouts.admin.master')

@section('content')
  <div id="lp" class="content">
    <div class="title-container">
      <h4 class="text-primary">LP Sport</h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item" aria-current="page">
            <a href="{{ route('admin.lp.sport.index') }}">Index</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Form</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <h5 class="text-primary">
          @if(!isset($data))
            <span>Tambah LP Sport</span>
          @else
            <span>Ubah LP Sport {{ $data->name }}</span>
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
          action="{{ route('admin.lp.sport.store') }}"
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
                <label for="lp_type_id">Nama LP *</label>
              </div>
              <div class="col-7">
                <select name="lp_type_id" class="form-select select2" id="lp_type_id" required>
                  <option disabled selected value>Please select ...</option>
                  @foreach ($types as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="channel_id">Nama Channel *</label>
              </div>
              <div class="col-7">
                <select name="channel_id" class="form-select select2" id="channel_id" required>
                  <option disabled selected value>Please select ...</option>
                  @foreach ($channels as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="short_link">Short Link</label>
              </div>
              <div class="col-7">
                <input type="text" class="form-control" name="short_link" id="short_link" value="{{ old('short_link', isset($data) ? $data->short_link : null) }}">
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="long_link">Long Link</label>
              </div>
              <div class="col-7">
                <input type="text" class="form-control" name="long_link" id="long_link" value="{{ old('long_link', isset($data) ? $data->long_link : null) }}">
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
@endsection

@section('script')
<script>
  let is_create = "<?php echo !isset($data) ? 1 : 0 ?>"
  is_create = !!parseInt(is_create)

  const channelSelected = "<?php echo old('channel_id', isset($data) ? $data->channel_id : null) ?>";
  const typeSelected = "<?php echo old('lp_type_id', isset($data) ? $data->lp_type_id : null) ?>";

  document.addEventListener('DOMContentLoaded', async function () {
    if (!is_create) $('#submit').removeClass('disabled')
    $('#channel_id').val(channelSelected).change();
    $('#lp_type_id').val(typeSelected).change();

    let validationTimeout
    $('#name').on('keyup', function () {
      const val = $(this).val()

      if (validationTimeout) clearTimeout(validationTimeout)
      validationTimeout = setTimeout(() => {
        const formData = new FormData()
        formData.append('name', val)

        fetch(`/api/lp/sport/validate`, {
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
