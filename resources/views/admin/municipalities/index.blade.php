@extends('layouts.admin.master')

@section('content')
  <div id="municipalities" class="content">
    <div class="title-container">
      <h4 class="text-primary">
        @if ($state_id != null)
          Kota di state {{ $state_name }}
        @else
          Kota
        @endif
      </h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        @if (empty($state_id))
          <a href="{{ route('admin.location.municipalities.create') }}" class="btn btn-primary btn-sm unrounded">
            Tambah baru&nbsp;
            <i class="fa-solid fa-plus"></i>
          </a>
        @else
          <a href="{{ route('admin.location.municipalities.create', ["state_id" => $state_id]) }}" class="btn btn-primary btn-sm unrounded">
            Tambah baru&nbsp;
            <i class="fa-solid fa-plus"></i>
          </a>
        @endif

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
    const state_id = "<?php echo $state_id ?>";

    document.addEventListener('DOMContentLoaded', async function () {
      const table = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "/api/city/listDatatable",
          type: 'POST',
          data: { state_id }
        },
        columns: [
          {data: 'name', title: 'Name', name: 'name'},
          {data: 'schools_count', title: 'Jumlah Sekolah', name: 'schools_count'},
          {data: 'county', title: 'State', name: 'county', 
            "render": function ( data, type, row, meta ) {
              return `${row.county.abbreviation} - ${data.name}`
            }
          },
          {data: 'id', title: 'Aksi', orderable: false, searchable: false,
            "render": function ( data, type, row, meta ) {
              let updateRoute
              if (state_id === '') {
                updateRoute = `/admin/location/municipalities/update/${data}`
              } else {
                updateRoute = `/admin/location/municipalities/update/${data}?state_id=${state_id}`
              }

              return `
                <a href="/admin/school?state_id=${row.county_id}&city_id=${data}" class="btn btn-sm unrounded btn-primary">
                  <small>Daftar Sekolah</small>
                </a>

                <a href="${updateRoute}" class="btn btn-sm unrounded btn-primary">
                  <small>Edit Kota</small>
                </a>

                <button
                  data-id="${data}"
                  data-name="${row.name}"
                  class="btn btn-sm btn-danger unrounded delete"
                >
                  <small>Hapus Kota</small>
                </button>
              `;
            }
          },
        ]
      });

      $('#datatable').on('click', '.delete', function () {
        const id = $(this).attr('data-id')
        const name = $(this).attr('data-name')

        const deleteURL = `/admin/location/municipalities/delete`
        const formData = new FormData()
        formData.append('id', id)
        formData.append('_token', csrfToken)

        swal({
          text: `Ingin menghapus sekolah ${name}?`,
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
                table.ajax.reload()
                swal({
                  title: 'Deleted',
                  icon: 'success',
                  text: `Sekolah ${name} berhasil dihapus`
                })
              } else {
                console.log(data.message)
                swal(data.message, { icon: 'error' });
              }
            })
          }
        });
      })
    })
  </script>
@endsection
