@extends('layouts.admin.master')

@section('content')
  <div id="countries" class="content">
    <div class="title-container">
      <h4 class="text-primary">Countries</h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item" aria-current="page">
            <a href="{{ route('admin.location.countries.index') }}">Index</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <h5 class="text-primary">
          Country Detail
        </h5>
      </div>

      <div class="data-center">
        <div class="row">
          <div class="col-7">
            <div class="row mb-3">
              <div class="col-5 text-secondary">
                <label for="name">Country Name</label>
              </div>
              <div class="col-7">
                <label class="">{{ $data->name }}</label> 
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-5 text-secondary">
                <label>Country Code</label>
              </div>
              <div class="col-7">
                <label class="">{{ $data->alpha2_code }}</label> 
              </div>
            </div>

            <div class="row">
              <div class="col-5 text-secondary">
                <label for="dial_code">Dial Code</label>
              </div>
              <div class="col-7">
                <label class="">{{ $data->dial_code }}</label> 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
