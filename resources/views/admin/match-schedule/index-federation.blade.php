@extends('layouts.admin.master')

@section('content')
  <div id="match-schedule" class="content">
    @if (Session::has("success"))
      <div class="alert alert-success">
        {{ Session::get("success") }}
      </div>
    @endif

    <div class="title-container">
      <h4 class="text-primary">Jadwal Pertandingan per Federasi</h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
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
          dom: '<"dt-top"if><"dt-t"rt><"dt-bottom"lp><"clear">',
          processing: true,
          serverSide: true,
          ajax: "/api/match-schedule/listOnFederation",
          columns: [
            {data: 'abbreviation', title: 'Nama Federasi', name: 'abbreviation'},
            {data: 'match_schedule_count', title: 'Jumlah Pertandingan', name: 'match_schedule_count'},
            {data: 'id', title: 'Aksi', orderable: false, searchable: false,
              "render": function ( data, type, row, meta ) {
                return `
                  <a href="/admin/match-schedule?federation_id=${data}" class="btn btn-sm unrounded btn-primary">
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