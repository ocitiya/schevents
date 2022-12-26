@extends('layouts.admin.master')

@section('content')
  <div id="schools" class="content">
    <div class="title-container">
      <h4 class="text-primary">
        Atlit
      </h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <a href="{{ route('admin.masterdata.athlete.create') }}" class="btn btn-primary btn-sm unrounded">
          Tambah Atlit&nbsp;
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
    let table = null;
    document.addEventListener('DOMContentLoaded', async function () {
      $('#datatable').on('click', '.delete', function () {
        const id = $(this).attr('data-id')
        const name = $(this).attr('data-name')

        const deleteURL = `/admin/masterdata/athlete/delete`
        const formData = new FormData()
        formData.append('id', id)
        formData.append('_token', csrfToken)

        swal({
          text: `Ingin menghapus atlit ${name}?`,
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
                  text: `Atlit ${name} berhasil dihapus`
                })
              } else {
                console.log(data.message)
                swal(data.message, { icon: 'error' });
              }
            })
          }
        });
      })

      $(function () {
        table = $('#datatable').DataTable({
          dom: '<"dt-top"if><"dt-t"rt><"dt-bottom"lp><"clear">',
          processing: true,
          serverSide: true,
          ajax: "/api/athlete/listDatatable",
          columns: [
            {data: 'name', title: 'Name', name: 'name'},
            {data: 'federation', title: 'Singkatan Federasi', name: 'federation',
              "render": function ( data, type, row, meta ) {
                if (data === null) {
                  return '-';
                } else {
                  return data.abbreviation;

                }
              }
            },
            {data: 'country', title: 'Negara', name: 'country',
              "render": function ( data, type, row, meta ) {
                if (data === null) {
                  return '-';
                } else {
                  if (data.alpha3_code === null || data.alpha3_code === '') {
                    return data.name
                  } else {
                    return `${data.alpha3_code} - ${data.name}`;
                  }
                }
              }
            },
            {data: 'county', title: 'State', name: 'county',
              "render": function ( data, type, row, meta ) {
                if (data === null) {
                  return '-';
                } else {
                  return `${row.county.abbreviation} - ${data.name}`;
                }
              }
            },
            {data: 'municipality', title: 'Kota', name: 'municipality',
              "render": function ( data, type, row, meta ) {
                if (data === null) {
                  return '-';
                } else {
                  return data.name;
                }
              }
            },
            {data: 'image', title: 'Foto', name: 'image',
              "render": function ( data, type, row, meta ) {
                if (data === null) {
                  return `
                    <img src="/images/no-logo-1.png" style="width: 75px" class="mb-3">
                  `
                } else {
                  return `
                    <img src="/storage/athlete/image/${data}" style="width: 75px" class="mb-3">
                  `
                }
              }
            },
            
            {data: 'id', title: 'Aksi', orderable: false, searchable: false,
              "render": function ( data, type, row, meta ) {
                const updateRoute = `/admin/masterdata/athlete/update/${data}`

                const deleteButton = `
                  <button
                    data-id="${data}"
                    data-name="${row.name}"
                    class="btn btn-sm btn-danger unrounded delete"
                  >
                    <small>Hapus Atlit</small>
                  </button>
                `;

                return `
                  <a href="${updateRoute}" class="btn btn-sm unrounded btn-primary">
                    <small>Edit Atlit</small>
                  </a>

                  ${deleteButton}
                `;
              }
            },
          ]
        });
      });
    })
  </script>
@endsection