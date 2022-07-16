@extends('layouts.admin.master')

@section('content')
  <div id="counties" class="content">
    <div class="title-container">
      <h4 class="text-primary">Kota</h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <a href="{{ route('admin.location.counties.create') }}" class="btn btn-primary btn-sm unrounded">
          Tambah Kota&nbsp;
          <i class="fa-solid fa-plus"></i>
        </a>

        <div>
          <form action="" autocomplete="off" method="POST">
            <input class="form-control" placeholder="Search" type="text" id="search">
          </form>
        </div>
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
            ajax: "/api/city/listDatatable",
            columns: [
              {data: 'name', title: 'Name', name: 'name'},
              {data: 'abbreviation', title: 'Singkatan', name: 'abbreviation'},
              {data: 'schools_count', title: 'Jumlah Sekolah', name: 'schools_count'},
              {data: 'id', title: 'Aksi', orderable: false, searchable: false,
                "render": function ( data, type, row, meta ) {
                  const updateRoute = `/admin/location/counties/update/${data}`

                  return `
                    <a href="/admin/school?city_id=${data}" class="btn btn-sm unrounded btn-primary">
                      <small>Daftar Sekolah</small>
                    </a>

                    <a href="${updateRoute}" class="btn btn-sm unrounded btn-primary">
                      <small>Edit Kota</small>
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