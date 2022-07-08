@extends('layouts.admin.master')

@section('content')
  <div id="school" class="content">
    <div class="title-container">
      <h4 class="text-primary">Schools</h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      @if (session()->has('message'))
        <div class="alert alert-success">
          <i class="fa-solid fa-check"></i>&nbsp;
          {{ session()->get('message') }}
        </div>
      @endif
      
      <div class="data-header">
        <a href="{{ route('admin.school.create') }}" class="btn btn-primary btn-sm unrounded">
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
          @forelse ($schools as $item)
            <div class="card text-center shadow-sm">
              <div class="card-header text-end">
                <button
                  data-id="{{ $item->id }}"
                  data-name="{{ $item->name }}"
                  class="btn btn-outline-danger btn-sm unrounded delete-item"
                >
                  Delete&nbsp;
                  <i class="fa-solid fa-trash"></i>
                </button>
              </div>
              <div class="card-body">
                <h5 class="card-title align-items-center card-body d-flex justify-content-center">
                  {{ $item->name }}
                </h5>
              </div>
              <div class="card-footer text-muted">
                <a
                  href="{{ route('admin.school.detail', ['id' => $item->id]) }}"
                  class="btn btn-primary btn-sm"
                >
                  View&nbsp;
                  <i class="fa-solid fa-eye"></i>
                </a>
                
                <a
                  href="{{ route('admin.school.update', ['id' => $item->id]) }}"
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
    const deleteURL = "<?php echo route('admin.school.delete') ?>"

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
        }, 1000)
      })
    })

    $('#school').on('click', '.delete-item', function(e) {
      const id = $(this).attr('data-id')
      const name = $(this).attr('data-name')

      const formData = new FormData()
      formData.append('id', id)
      formData.append('_token', csrfToken)
      
      swal({
        text: `Are you want to delete ${name}?`,
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          fetch(deleteURL, {
            method: 'POST',
            body: formData
          }).then(res => res.json()).then(data => {
            if (data.status) {
              window.location.reload()
            } else {
              console.log(data.message)
              swal(data.message, { icon: 'error' });
            }
          })
        }
      });
    })
  </script>
@endsection