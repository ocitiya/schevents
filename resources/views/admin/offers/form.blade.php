@extends('layouts.admin.master')

@section('content')
  <div id="channel" class="content">
    <div class="title-container">
      <h4 class="text-primary">Promosi</h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item" aria-current="page">
            <a href="{{ route('admin.offer.index') }}">Index</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Form</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <h5 class="text-primary">
          @if(!isset($data))
            <span>Tambah Promosi</span>
          @else
            <span>Ubah Promosi {{ $data->name }}</span>
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
          action="{{ route('admin.offer.store') }}"
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

            <div class="row">
              <div class="col-5">
                <label for="long_link">Long Link *</label>
              </div>
              <div class="col-7">
                <input type="text" class="form-control" name="long_link" id="long_link" value="{{ old('long_link', isset($data) ? $data->long_link : null) }}">
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="short_link">Short Link *</label>
              </div>
              <div class="col-7">
                <input type="text" class="form-control" name="short_link" id="short_link" value="{{ old('short_link', isset($data) ? $data->short_link : null) }}">
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

    document.addEventListener('DOMContentLoaded', async function () {
      $('#campaign_id').on('change', async function () {
        const val = $(this).val()

        const banners = await getList(`/api/offer/banner/list?showall=true&campaign_id=${val}`)
        generateSelect('#banner_id', banners, false)
        $('#banner_id').val(bannerSelected).change()
      });

      $('#campaign_id').val(campaignSelected).change();
      $('#banner_id').val(bannerSelected).change();
      $('#channel_id').val(channelSelected).change();
    });
  </script>
@endsection
