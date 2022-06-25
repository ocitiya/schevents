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
          <li class="breadcrumb-item active" aria-current="page">Form</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <h5 class="text-primary">
          @empty($id)
            <span>Create New Country</span>
          @endempty

          @isset($id)
            <span>Update Country</span>
          @endisset
        </h5>
      </div>

      <div class="data-center">
        <form class="form-container row" autocomplete="off">
          <div class="col-6">
            <div class="row">
              <div class="col-5">
                <label for="name">Country Name</label>
              </div>
              <div class="col-7">
                <input type="text" name="name" class="form-control">
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="name">Country Code</label>
              </div>
              <div class="col-7">
                <input type="text" name="code" class="form-control">
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
