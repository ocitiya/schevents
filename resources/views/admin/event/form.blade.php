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
                <label for="start_time">Jam Awal</label>
              </div>
              <div class="col-7">
                <input type="time" name="start_time" id="start_time" class="form-control" value="{{ old('start_time', isset($data) ? $data->start_time : null) }}">
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="end_date">Tanggal Akhir Event</label>
              </div>
              <div class="col-7">
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', isset($data) ? $data->end_date : null) }}">
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="end_time">Jam Akhir</label>
              </div>
              <div class="col-7">
                <input type="time" name="end_time" id="end_time" class="form-control" value="{{ old('end_time', isset($data) ? $data->end_time : null) }}">
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="campaign_id">Nama Campaign *</label>
              </div>
              <div class="col-7">
                <select name="campaign_id" class="form-select select2" id="campaign_id" required>
                  <option disabled selected value>Please select ...</option>
                  @foreach ($campaign as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            
            <div class="row">
              <div class="col-5">
                <label for="banner_id">Nama Banner *</label>
              </div>
              <div class="col-7">
                <select name="banner_id" class="form-select select2" id="banner_id" required>
                  <option disabled selected value>Please select ...</option>
                  {{-- Dynamic Data --}}
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="lp_type_id">Tipe LP *</label>
              </div>
              <div class="col-7">
                <select name="lp_type_id" class="form-select select2" id="lp_type_id" required>
                  <option disabled selected value>Please select ...</option>
                  @foreach ($lp_types as $item)
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

            <div id="offer-invalidate" class="alert alert-warning mt-3 align-items-center" role="alert" style="display: none">
              <i class="fas fa-exclamation-circle"></i>        
              
              <div class="message ms-3">
                {{-- Dynamic Data --}}
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
    let is_create = "<?php echo !isset($data) ? 1 : 0 ?>";
    is_create = !!parseInt(is_create);

    const campaignSelected = "<?php echo old('campaign_id', isset($data) ? $data->campaign_id : null) ?>";
    const bannerSelected = "<?php echo old('banner_id', isset($data) ? $data->banner_id : null) ?>";
    const channelSelected = "<?php echo old('channel_id', isset($data) ? $data->channel_id : null) ?>";
    const lpTypeSelected = "<?php echo old('lp_type_id', isset($data) ? $data->lp_type_id : null) ?>";

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

    const validateOffer = () => {
      const campaign_id = $('#campaign_id').val();
      const banner_id = $('#banner_id').val();
      const channel_id = $('#channel_id').val();

      $('#offer-invalidate').hide();

      if (!campaign_id || !banner_id || !channel_id) return false;

      const formData = new FormData();
      formData.append('campaign_id', campaign_id);
      formData.append('banner_id', banner_id);
      formData.append('channel_id', channel_id);

      fetch('/api/offer/validateOffer', {
        method: 'POST',
        body: formData
      })
        .then(res => res.json())
        .then(res => {
          if (!res.status) {
            $('#offer-invalidate').css('display', 'flex');
            $('#offer-invalidate .message').text(res.message);
          }
        });
    }

    document.addEventListener('DOMContentLoaded', async function () {
      if (!is_create) $('#submit').removeClass('disabled');

      $('#campaign_id').on('change', async function () {
        const val = $(this).val();

        const banners = await getList(`/api/offer/banner/list?showall=true&campaign_id=${val}`);
        generateSelect('#banner_id', banners, false);
        $('#banner_id').val(bannerSelected).change();

        validateOffer();
      });

      $('#banner_id').on('change', async function () {
        validateOffer();
      });

      $('#channel_id').on('change', async function () {
        validateOffer();
      });

      $('#campaign_id').val(campaignSelected).change();
      $('#banner_id').val(bannerSelected).change();
      $('#channel_id').val(channelSelected).change();
      $('#lp_type_id').val(lpTypeSelected).change();

      let validationTimeout
      $('#name').on('keyup', function () {
        const val = $(this).val();

        if (validationTimeout) clearTimeout(validationTimeout)
        validationTimeout = setTimeout(() => {
          const formData = new FormData();
          formData.append('name', val);

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
            });
        }, 1000);
      });

      tinymce.init({
        menubar: false,
        selector: '#description',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo bold italic underline align | strikethrough | blocks fontfamily fontsize | link image media table | lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
      });
    });
  </script>
@endsection