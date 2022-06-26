@extends('layouts.admin.master')

@section('content')
  <div id="provinces" class="content">
    <div class="title-container">
      <h4 class="text-primary">Provinces</h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <a href="{{ route('admin.location.provinces.create') }}" class="btn btn-primary btn-sm unrounded">
          Create New&nbsp;
          <i class="fa-solid fa-plus"></i>
        </a>

        <div>
          <form action="" autocomplete="off" method="POST">
            <input class="form-control" placeholder="Search" type="text" id="search" value="{{ $search }}">
          </form>
        </div>
      </div>

      <div class="data-center">
        <div class="data-list">
          @forelse ($provinces as $item)
            <div class="card text-center shadow-sm">
              <div class="card-body">
                <h5 class="card-title">{{ $item->name }}</h5>
                <div class="card-text">
                  <small>Country</small>
                  <div>{{ $item->country->name }}</div>
                </div>
              </div>
              <div class="card-footer text-muted">
                <a
                  href="{{ route('admin.location.provinces.detail', ['id' => $item->id]) }}"
                  class="btn btn-primary btn-sm"
                >
                  View&nbsp;
                  <i class="fa-solid fa-eye"></i>
                </a>
                
                <a
                  href="{{ route('admin.location.provinces.update', ['id' => $item->id]) }}"
                  class="btn btn-primary btn-sm"
                >
                  Edit&nbsp;
                  <i class="fa-solid fa-pen-to-square"></i>
                </a>
              </div>
            </div>
          @empty
            There is No Data
          @endforelse
        </div>
      </div>

      <div class="data-footer">
        <nav aria-label="Page navigation example">
          <ul class="pagination d-flex align-items-center justify-content-end">
            <li class="page-item">
              <button
                class="page-link {{ $page == 1 ? 'disabled' : null }}"
                id="previous"
                aria-label="Previous"
              >
                <span aria-hidden="true">&laquo;</span>
              </button>
            </li>
            <li>
              <div class="input-group">
                <input type="text" class="form-control" id="pagination" value="{{ $page }}">
                <div class="input-group-append">
                  <div class="input-group-text">&nbsp;/&nbsp;{{ $total_page }}</div>
                </div>
              </div>
            </li>
            <li class="page-item">
              <button
                class="page-link {{ $page >= $total_page ? 'disabled' : null }}"
                id="next"
                aria-label="Next"
              >
                <span aria-hidden="true">&raquo;</span>
              </button>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    let searchTimeout = null;
    let pageTimeout = null;
    
    document.addEventListener('DOMContentLoaded', function() {
      $('#next').on('click', function() {
        let page = getParams('page')
        if (page === null) page = 1

        setParams('page', parseInt(page) + 1)
      })

      $('#previous').on('click', function() {
        let page = getParams('page')
        if (page === null) page = 1
        
        setParams('page', parseInt(page) - 1)
      })

      $('#pagination').on('keyup', function() {
        const val = $(this).val()

        searchTimeout = setTimeout(() => {
          setParams('page', val)
        }, 1000)
      })

      $('#search').on('keyup', function () {
        const val = $(this).val()

        if (searchTimeout !== null) clearTimeout(searchTimeout)
        searchTimeout = setTimeout(() => {
          setParams('search', val)
        }, 1000);
      })
    })
  </script>
@endsection