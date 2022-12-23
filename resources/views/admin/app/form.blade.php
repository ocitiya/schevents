@extends('layouts.admin.master')

@section('content')
  <div id="socmed" class="content">
    <div class="title-container">
      <h4 class="text-primary">App Profile</h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item" aria-current="page">
            <a href="{{ route('admin.app.profile.index') }}">Index</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Form</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <h5 class="text-primary">
          <span>Edit Profile Aplikasi</span>
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
          action="{{ route('admin.app.profile.store') }}"
          method="POST"
          autocomplete="off"
          enctype="multipart/form-data"
          class="form-container row"
        >
          {{ csrf_field() }}

          <input type="hidden" name="id" value="{{ isset($data) ? $data->id : null }}">

          <div class="col-12 col-sm-9">
            <div class="row">
              <div class="col-5">
                <label for="name">Nama *</label>
              </div>
              <div class="col-7">
                <input type="text" name="name" id="s" class="form-control" value="{{ old('name', isset($data) ? $data->name : null) }}" required>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="description">Deskripsi *</label>
              </div>
              <div class="col-7">
                <textarea class="form-control" name="description" id="description" rows="3" required>{{ old('description', isset($data) ? $data->description : null) }}</textarea>
              </div>
            </div>

            @if (isset($data))
              <div class="row">
                <div class="col-5"></div>
                <div class="col-7">
                  @if (empty($data->logo))
                    <img src="/images/no-logo-1.png" style="width: 100%">
                  @else
                    <img src="{{"/storage/app/image/{$data->logo}" }}" style="width: 100%">
                  @endif
                </div>
              </div>
            @endif

            <div class="row">
              <div class="col-5">
                <label for="image">Logo</label>
              </div>
              <div class="col-7">
                <input type="file" name="image" id="image" class="form-control" accept=".png, .jpg">
                <div class="">
                  <small>Upload again to change logo | File type: .jpg, .png</small><br><br>
                </div>
              </div>
            </div>

            <div class="form-button">
              <button type="submit" class="btn btn-primary btn-sm unrounded">
                Update&nbsp;
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
    document.addEventListener('DOMContentLoaded', function() {
      tinymce.init({
        menubar: false,
        selector: '#description',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo bold italic underline align | strikethrough | blocks fontfamily fontsize | link image media table | lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
      });
    });
  </script>
@endsection
