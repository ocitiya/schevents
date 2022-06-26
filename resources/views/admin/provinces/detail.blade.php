@extends('layouts.admin.master')

@section('content')
  <div id="provinces" class="content">
    <div class="title-container">
      <h4 class="text-primary">Provinces</h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item" aria-current="page">
            <a href="{{ route('admin.location.provinces.index') }}">Index</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <h5 class="text-primary">
          Province Detail
        </h5>
      </div>

      <div class="data-center">
        <div class="row">
          <div class="col-7">
            <div class="row mb-3">
              <div class="col-5 text-secondary">
                <label for="name">Country</label>
              </div>
              <div class="col-7">
                <label class="">{{ $data->country->name }}</label> 
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-5 text-secondary">
                <label for="name">Province Name</label>
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
