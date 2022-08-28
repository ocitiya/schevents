@extends('layouts.admin.master')

@section('content')
  <div id="municipalities" class="content">
    <div class="title-container">
      <h4 class="text-primary">Kota</h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item" aria-current="page">
            <a href="{{ route('admin.location.municipalities.index') }}">Index</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Form</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <h5 class="text-primary">
          @if(!isset($data))
            <span>Tambah Kota Baru</span>
          @else
            <span>Edit Kota</span>
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
          action="{{ route('admin.location.municipalities.store') }}"
          method="POST"
          autocomplete="off"
          class="form-container row"
          enctype="multipart/form-data"
        >
          {{ csrf_field() }}

          @if (!empty($state_id))
            <input type="hidden" name="isStateDefault" value="true">
          @endif

          <input type="hidden" name="id" value="{{ isset($data) ? $data->id : null }}">

          <div class="col-6">
            <div class="row">
              <div class="col-5">
                <label for="name">State *</label>
              </div>
              <div class="col-7">
                <select name="county_id" class="select2 form-select" id="county_id">
                  <option disabled selected value>Please select ...</option>
                  @foreach ($counties as $item)
                    <option value="{{ $item->id }}">{{  $item->abbreviation}} - {{ $item->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            
            <div class="row">
              <div class="col-5">
                <label for="name">Nama Kota *</label>
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
    const state_id = "<?php echo $state_id ?>";
    const countySelected = "<?php echo old('county_id', isset($data) ? $data->county_id : $state_id) ?>";

    document.addEventListener('DOMContentLoaded', function() {
      $('#county_id').val(countySelected).change()

      if (state_id !== "") {
        $('#county_id').prop('disabled', true)
        $(`<input type="hidden" name="county_id" value="${state_id}" />`).insertBefore('#county_id')
      }
    })
  </script>
@endsection
