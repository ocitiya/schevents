@extends('layouts.admin.master')

@section('content')
  <div id="countries" class="content">
    <div class="title-container">
      <h4 class="text-primary">Countries</h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
      </nav>
    </div>


    <div class="data-container">
      <div class="data-header">

      </div>

      <div class="data-center">
        <div class="data-list">
          <div class="card text-center shadow-sm">
            <div class="card-body">
              <h5 class="card-title">Indonesia</h5>
              <div class="card-text">
                <small>Code</small>
                <div>ID</div>
              </div>
            </div>
            <div class="card-footer text-muted">
              <div class="btn btn-primary btn-sm">
                Edit&nbsp;
                <i class="fa-solid fa-pen-to-square"></i>
              </div>
            </div>
          </div>

          <div class="card text-center shadow-sm">
            <div class="card-body">
              <h5 class="card-title">Japan</h5>
              <div class="card-text">
                <small>Code</small>
                <div>JP</div>
              </div>
            </div>
            <div class="card-footer text-muted">
              <div class="btn btn-primary btn-sm">
                Edit&nbsp;
                <i class="fa-solid fa-pen-to-square"></i>
              </div>
            </div>
          </div>

          <div class="card text-center shadow-sm">
            <div class="card-body">
              <h5 class="card-title">USA</h5>
              <div class="card-text">
                <small>Code</small>
                <div>US</div>
              </div>
            </div>
            <div class="card-footer text-muted">
              <div class="btn btn-primary btn-sm">
                Edit&nbsp;
                <i class="fa-solid fa-pen-to-square"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="data-footer">

      </div>
    </div>
  </div>
@endsection