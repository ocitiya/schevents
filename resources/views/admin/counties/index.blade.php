@extends('layouts.admin.master')

@section('content')
  <div id="counties" class="content">
    <div class="title-container">
      <h4 class="text-primary">State</h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <a href="{{ route('admin.location.counties.create') }}" class="btn btn-primary btn-sm unrounded">
          Tambah State&nbsp;
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
            ajax: "/api/state/listDatatable",
            columns: [
              {data: 'logo', title: 'Logo', name: 'logo',
                "render": function ( data, type, row, meta ) {
                  if (data === null) {
                    return '-'
                  } else {
                    return `<img src="/storage/counties/logo/${data}" style="width: 75px" class="mb-3">`
                  }
                },
              },
              {data: 'name', title: 'Name', name: 'name'},
              {data: 'abbreviation', title: 'Singkatan', name: 'abbreviation'},
              {data: 'municipality_count', title: 'Jumlah Kota', name: 'municipality_count'},
              {data: 'id', title: 'Aksi', orderable: false, searchable: false,
                "render": function ( data, type, row, meta ) {
                  const updateRoute = `/admin/location/counties/update/${data}`
                  const municipalityRoute = `/admin/location/municipalities?state=${data}`

                  return `
                    <a href="${updateRoute}" class="btn btn-sm unrounded btn-primary">
                      <small>Edit State</small>
                    </a>
                    <a href="${municipalityRoute}" class="btn btn-sm unrounded btn-primary">
                      <small>Data Kota</small>
                    </a>
                  `;
                }
              },
            ]
        });
      });
    })
  </script>
@endsection