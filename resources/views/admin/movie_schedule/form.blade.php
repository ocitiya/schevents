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
    const campaignSelected = "<?php echo old('campaign_id', isset($data) ? $data->campaign_id : null) ?>";
    const bannerSelected = "<?php echo old('banner_id', isset($data) ? $data->banner_id : null) ?>";
    const channelSelected = "<?php echo old('channel_id', isset($data) ? $data->channel_id : null) ?>";

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

      if (!campaign_id || !banner_id || !channel_id) {
        return false;
      }

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

      $('#movie_id').val(movieSelected).change();
      $('#campaign_id').val(campaignSelected).change();
      $('#banner_id').val(bannerSelected).change();
      $('#channel_id').val(channelSelected).change();
    });
  </script>
@endsection
