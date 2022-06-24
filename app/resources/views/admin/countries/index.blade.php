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
        <a href="{{ route('admin.location.countries.create') }}" class="btn btn-primary btn-sm unrounded">
          Create New&nbsp;
          <i class="fa-solid fa-plus"></i>
        </a>

        <div>
          <form action="" autocomplete="off" method="POST">
            <input class="form-control" placeholder="Search" type="text" name="search">
          </form>
        </div>
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
              <a
                href="{{ route('admin.location.countries.update', ['id' => 1]) }}"
                class="btn btn-primary btn-sm"
              >
                Edit&nbsp;
                <i class="fa-solid fa-pen-to-square"></i>
              </a>
            </div>
          </div>

          <div class="card text-center shadow-sm">
            <div class="card-body">
              <h5 class="card-title">Japan</h5>
              <div class="card-text">
                <div class="card-description">
                  <small>Code</small>
                  <div>JP</div>
                </div>
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
        <nav aria-label="Page navigation example">
          <ul class="pagination d-flex align-items-center justify-content-end">
            <li class="page-item">
              <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
@endsection