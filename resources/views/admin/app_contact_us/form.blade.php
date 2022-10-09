@extends('layouts.admin.master')

@section('content')
  <div id="socmed" class="content">
    <div class="title-container">
      <h4 class="text-primary">App Contact Us</h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item" aria-current="page">
            <a href="{{ route('admin.app.contact_us.index') }}">Index</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Form</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <h5 class="text-primary">
          <span>{{ isset($data) ? "Update" : "Create" }} App Contact Us</span>
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
          action="{{ route('admin.app.contact_us.store') }}"
          method="POST"
          autocomplete="off"
          enctype="multipart/form-data"
          class="form-container row"
        >
          {{ csrf_field() }}

          <input type="hidden" name="id" value="{{ isset($data) ? $data->id : null }}">

          <div class="col-md-7 col-12 col-sm-10">
            <div class="row">
              <div class="col-5">
                <label for="name">Nama *</label>
              </div>
              <div class="col-7">
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', isset($data) ? $data->name : null) }}" required>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="info">Info *</label>
              </div>
              <div class="col-7">
                <textarea class="form-control" name="info" id="info" rows="3" required>{{ old('info', isset($data) ? $data->info : null) }}</textarea>
              </div>
            </div>

            @if (isset($data))
              <div class="row">
                <div class="col-5"></div>
                <div class="col-7">
                  @if (empty($data->logo))
                    <img src="/images/no-logo-1.png" style="width: 100%">
                  @else
                    <img src="{{ "/storage/app_contact_us/image/{$data->logo}" }}" style="width: 100%">
                  @endif
                </div>
              </div>

              <div class="row">
                <div class="col-5">
                  <label for="image">Logo</label>
                </div>
                <div class="col-7">
                  <input type="file" name="image" id="image" class="form-control" accept=".png, .jpg">
                  <small>Upload again to change logo | File type: .jpg, .png</small><br><br>
                </div>
              </div>
            @else
            <div class="row">
              <div class="col-5">
                <label for="image">Logo *</label>
              </div>
              <div class="col-7">
                <input required type="file" name="image" id="image" class="form-control" accept=".png, .jpg">
              </div>
            </div>
            @endif

            <div class="form-button">
              <button type="submit" class="btn btn-primary btn-sm unrounded">
                {{ isset($data) ? "Update" : "Create" }}&nbsp;
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
