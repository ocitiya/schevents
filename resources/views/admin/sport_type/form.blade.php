@extends('layouts.admin.master')

@section('content')
  <div id="sport_type" class="content">
    <div class="title-container">
      <h4 class="text-primary">Link Stream</h4>

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
            <span>Link Stream Baru</span>
          @else
            <span>Ubah Link Stream {{ $data->name }}</span>
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
          action="{{ route('admin.sport.type.store') }}"
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
                <label for="sport_id">Olahraga *</label>
              </div>
              <div class="col-7">
                <select name="sport_id" class="form-select select2" id="sport_id">
                  {{-- Dynamic Data --}}
                </select>
              </div>
            </div>

            @if (isset($data))
              <div class="row">
                <div class="col-5"></div>
                <div class="col-7">
                  <img src="{{"/storage/sport/image/{$data->image}" }}" style="width: 100%">
                </div>
              </div>
            @endif

            <div class="row">
              <div class="col-5">
                <label for="federation_id">Federasi *</label>
              </div>
              <div class="col-7">
                <select class="form-select select2" id="federation_id" name="federation_id">
                  <option disabled selected value>Please select ...</option>
                  @foreach ($federations as $item)
                    <option value="{{ $item->id }}">{{ $item->abbreviation }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="stream_url">Nama Pemilik</label>
              </div>
              <div class="col-7">
                <input type="text" class="form-control" value="{{ Auth::user()->name }}" disabled>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="stream_url">Link Stream *</label>
              </div>
              <div class="col-7">
                <input type="url" name="stream_url" id="stream_url" class="form-control" required value="{{ old('stream_url', isset($data) ? $data->stream_url : null) }}">
              </div>
            </div>

            @if ($default_federation != null)
              <input type="hidden" name="is_default_federation" value="1">
            @endif

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
    const federationSelected = "<?php echo old('federation_id', isset($data) ? $data->federation_id : $default_federation) ?>";
    const federationDefault = "<?php echo $default_federation ? 1 : 0 ?>"
    let sportSelected = "<?php echo old('sport_id', isset($data) ? $data->sport_id : null) ?>";

    let is_create = "<?php echo !isset($data) ? 1 : 0 ?>"
    is_create = !!parseInt(is_create)

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
      const sports = await getList(`/api/sport/list?showall=true`)
      generateSelect('#sport_id', sports, false)
      $('#sport_id').val(sportSelected).change()

      if (!is_create) $('#submit').removeClass('disabled')
      $('#federation_id').val(federationSelected).change()
      if (federationDefault == 1) {
        $('#federation_id').prop('disabled', true)
        $(`<input type="hidden" name="federation_id" value="${federationSelected}">`).insertBefore('#federation_id')
      }

      let validationTimeout
      $('#name').on('keyup', function () {
        const val = $(this).val()

        if (validationTimeout) clearTimeout(validationTimeout)
        validationTimeout = setTimeout(() => {
          const formData = new FormData()
          formData.append('name', val)

          fetch(`/api/sport-type/validate`, {
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