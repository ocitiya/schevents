@extends('layouts.admin.master')

@php
@endphp

@section('content')
  <div id="sport_types" class="content">
    <div class="title-container">
      <h4 class="text-primary">Link Stream {{ $data->campaign->name }}</h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item" aria-current="page">
            <a href="{{ route('admin.sport.type.index') }}">Index</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <h5 class="text-primary">
          Detail Link Stream
        </h5>
      </div>

      <div class="data-center">
        <div class="row">
          <div class="col-7">
            <div class="row mb-3">
              <div class="col-5 text-secondary">
                <label for="name">Nama Channel</label>
              </div>
              <div class="col-7">
                <label class="">{{ $data->channel->name }}</label> 
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-7">
            <div class="row mb-3">
              <div class="col-5 text-secondary">
                <label for="name">Nama Banner</label>
              </div>
              <div class="col-7">
                <label class="">{{ $data->banner->name }}</label> 
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-7">
            <div class="row mb-3">
              <div class="col-5 text-secondary">
                <label for="name">Nama Campaign</label>
              </div>
              <div class="col-7 d-flex align-items-center">
                <div class="me-3">
                  <label class="">{{ $data->campaign->name }}</label>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-7">
            <div class="row mb-3">
              <div class="col-5 text-secondary">
                <label for="name">Long Link</label>
              </div>
              <div class="col-7 d-flex align-items-center">
                <div class="me-3">
                  <label class="">{{ $data->long_link }}</label>
                </div>
                <div>
                  <button class="btn btn-primary btn-sm me-2 unrounded" id="copy-long" data-value="{{ $data->long_link }}">
                    Copy
                  </button>
                </div>
                <div>
                  <a href="{{ $data->long_link }}" target="_blank" class="btn btn-primary btn-sm unrounded">Open</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-7">
            <div class="row mb-3">
              <div class="col-5 text-secondary">
                <label for="name">Short Link</label>
              </div>
              <div class="col-7 d-flex align-items-center">
                <div class="me-3">
                  <label class="">{{ $data->short_link }}</label>
                </div>
                <div>
                  <button class="btn btn-primary btn-sm me-2 unrounded" id="copy-short" data-value="{{ $data->short_link }}">
                    Copy
                  </button>
                </div>
                <div>
                  <a href="{{ $data->short_link }}" target="_blank" class="btn btn-primary btn-sm unrounded">Open</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const copyShort = document.querySelector('#copy-short');

      copyShort.addEventListener('click', function () {
        const text = this.dataset.value;
        copyContent(text);
      });

      const copyLong = document.querySelector('#copy-long');

      copyLong.addEventListener('click', function () {
        const text = this.dataset.value;
        copyContent(text);
      });
    });

    const copyContent = async (text) => {
      try {
        await navigator.clipboard.writeText(text);
        alert('Content copied to clipboard');
      } catch (err) {
        alert('Failed to copy: ', err);
      }
    }
  </script>
@endsection
