@extends('layouts.admin.master')

@section('content')
  <div id="sport_types" class="content">
    <div class="title-container">
      <h4 class="text-primary">Banner</h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item" aria-current="page">
            <a href="{{ route('admin.app.banner.index') }}">Index</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <h5 class="text-primary">
          Detail Banner
        </h5>
      </div>

      <div class="data-center">
        <div class="row">
          <div class="col-7">
            <div class="row mb-3">
              <div class="col-5 text-secondary">
                <label for="name">Nama Cabang Olahraga</label>
              </div>
              <div class="col-7">
                <label class="">{{ $data->name }}</label> 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
