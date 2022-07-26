@extends('layouts.admin.master')

@section('content')
  <div id="match-schedule" class="content">
    @if (Session::has("success"))
      <div class="alert alert-success">
        {{ Session::get("success") }}
      </div>
    @endif

    <div class="title-container">
      <h4 class="text-primary">Match Schedule</h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <a href="{{ route('admin.match-schedule.all.create') }}" class="btn btn-primary btn-sm unrounded">
          Create New&nbsp;
          <i class="fa-solid fa-plus"></i>
        </a>
      </div>

      <div class="data-center">
        <table id="datatable" class="table table-bordered"></table>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    document.addEventListener('DOMContentLoaded', async function () {
      $(function () {
        const table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/api/match-schedule/cityMatchDatatable",
            columns: [
              {data: 'name', title: 'Nama Kota', name: 'name'},
              {data: 'match_count', title: 'Jumlah Pertandingan', name: 'match_count'},
              {data: 'id', title: 'Aksi', orderable: false, searchable: false,
                "render": function ( data, type, row, meta ) {
                  return `
                    <a href="/admin/match-schedule/city/${data}" class="btn btn-sm unrounded btn-primary">
                      <small>Daftar Pertandingan</small>
                    </a>
                  `;
                }
              },
            ]
        })
      })
    })
  </script>
@endsection