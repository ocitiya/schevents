@extends('layouts.admin.master')

@section('content')
  <div id="countries" class="content">
    <div class="title-container">
      <h4 class="text-primary">Negara</h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <a href="{{ route('admin.location.countries.create') }}" class="btn btn-primary btn-sm unrounded">
          Tambah Negara&nbsp;
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
      let table;
      
      $('#datatable').on('click', '.delete', function () {
        const id = $(this).attr('data-id');
        const name = $(this).attr('data-name');

        const deleteURL = `/admin/location/countries/delete`;
        const formData = new FormData();
        formData.append('id', id);
        formData.append('_token', csrfToken);

        swal({
          text: `Ingin menghapus negara ${name}?`,
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
                table.ajax.reload();
                swal({
                  title: 'Deleted',
                  icon: 'success',
                  text: `Negara ${name} berhasil dihapus`
                });
              } else {
                console.log(data.message);
                swal(data.message, { icon: 'error' });
              }
            })
          }
        });
      });
      
      $(function () {
        table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/api/country/listDatatable",
            columns: [
              {data: 'image', title: 'Logo', name: 'image',
                "render": function ( data, type, row, meta ) {
                  if (data === null) {
                    return '<img src="/images/no-logo-1.png" style="width: 75px" class="mb-3">'
                  } else {
                    return `<img src="/storage/countries/image/${data}" style="width: 75px" class="mb-3">`
                  }
                },
              },
              {data: 'name', title: 'Name', name: 'name'},
              {data: 'alpha3_code', title: 'Singkatan', name: 'alpha3_code'},
              {data: 'id', title: 'Aksi', orderable: false, searchable: false,
                "render": function ( data, type, row, meta ) {
                  const updateRoute = `/admin/location/countries/update/${data}`

                  return `
                    <a href="${updateRoute}" class="btn btn-sm unrounded btn-primary">
                      <small>Edit Negara</small>
                    </a>

                    <div class="mt-2">
                      <button
                        data-id="${data}"
                        data-name="${row.name}"
                        class="btn btn-sm btn-danger unrounded delete"
                      >
                        <small>Hapus Negara</small>
                      </button>
                    </div>
                  `;
                }
              },
            ]
        });
      });
    })
  </script>
@endsection
