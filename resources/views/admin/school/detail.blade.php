@extends('layouts.admin.master')

@section('content')
  <div id="school" class="content">
    <div class="title-container">
      <h4 class="text-primary">Sekolah</h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item" aria-current="page">
            <a href="{{ route('admin.school.index') }}">Index</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <h5 class="text-primary">
          Detail Sekolah
        </h5>
      </div>

      <div class="data-center">
        <div class="row">
          <div class="col-7">
            <div class="row mb-5 ms-sm-auto d-flex justify-content-center align-items-center logo-container">
              <img src="{{"/storage/school/logo/{$data->logo}" }}" style="width: 200px">
            </div>

            <div class="row mb-3">
              <div class="col-5 text-secondary">
                <label for="name">Name</label>
              </div>
              <div class="col-7">
                <label class="">{{ $data->name }}</label> 
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-5 text-secondary">
                <label for="name">Kota</label>
              </div>
              <div class="col-7">
                <label class="">{{ $data->county->name }}</label> 
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-5 text-secondary">
                <label for="name">Level of Education</label>
              </div>
              <div class="col-7">
                <label class="text-capitalize">{{ $data->level_of_education }}</label> 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
