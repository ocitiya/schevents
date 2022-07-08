@extends('layouts.admin.master')

@section('content')
  <div id="sport_type" class="content">
    <div class="title-container">
      <h4 class="text-primary">Sport Types</h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item" aria-current="page">
            <a href="{{ route('admin.sport.type.index') }}">Index</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Form</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <h5 class="text-primary">
          @if(!isset($data))
            <span>Create New Sport Type</span>
          @else
            <span>Update Sport Type</span>
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
          action="{{ route('admin.sport.type.store') }}"
          method="POST"
          autocomplete="off"
          class="form-container row"
        >
          {{ csrf_field() }}

          <input type="hidden" name="id" value="{{ isset($data) ? $data->id : null }}">

          <div class="col-6">
            <div class="row">
              <div class="col-5">
                <label for="name">Type Name *</label>
              </div>
              <div class="col-7">
                <input type="text" id="name" name="name" class="form-control capitalize"
                  value="{{ old('name', isset($data) ? $data->name : null) }}"
                >
              </div>
            </div>

            <div class="form-button">
              <button type="submit" class="btn btn-primary btn-sm unrounded">
                Submit&nbsp;
                <i class="fa-solid fa-paper-plane"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    const provinceSelected = "<?php echo old('county_id', isset($data) ? $data->county_id : null) ?>";

    document.addEventListener('DOMContentLoaded', function() {
      $('#county_id').val(provinceSelected).change()
    })
  </script>
@endsection
