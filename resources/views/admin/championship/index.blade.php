@extends('layouts.admin.master')

@section('content')
  <div id="championship" class="content">
    <div class="title-container">
      <h4 class="text-primary">
        Kejuaraan / Liga
      </h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <a href="{{ route('admin.masterdata.championship.create') }}" class="btn btn-primary btn-sm unrounded">
          Tambah Kejuaraan / Liga &nbsp;
          <i class="fa-solid fa-plus"></i>
        </a>
      </div>

      <div class="data-center">
        <div id="type-items">
          <table id="datatable" class="table table-bordered" style="font-size: small"></table>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    $('#datatable').on('click', '.delete', function () {
      const id = $(this).attr('data-id');
      const name = $(this).attr('data-name');

      const deleteURL = `/admin/masterdata/championship/delete`;
      const formData = new FormData();
      formData.append('id', id);
      formData.append('_token', csrfToken);

      swal({
        text: `Ingin menghapus kejuaraan ${name}?`,
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
                text: `Kejuaraan ${name} berhasil dihapus`
              });
            } else {
              swal(data.message, { icon: 'error' });
            }
          });
        }
      });
    });

    document.addEventListener('DOMContentLoaded', async function () {
      $(function () {
        table = $('#datatable').DataTable({
          dom: '<"dt-top"if><"dt-t"rt><"dt-bottom"lp><"clear">',
          processing: true,
          serverSide: true,
          ajax: {
          url: "/api/championship/listDatatable"
          },
          columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', title: 'No',  orderable: false, searchable: false },
            { data: 'name', name: 'name', title: 'Nama' },
            { data: 'abbreviation', name: 'abbreviation', title: 'Singkatan', 
              "render": function ( data, type, row, meta ) {
                return data || '-';
              }
            },
            {data: 'image', title: 'Logo', name: 'image',
                "render": function ( data, type, row, meta ) {
                  if (data === null) {
                    return `
                      <img src="/images/no-logo-1.png" style="width: 75px" class="mb-3">
                    `
                  } else {
                    return `
                      <img src="/storage/championship/image/${data}" style="width: 75px" class="mb-3">
                    `
                  }
                }
              },
            {data: 'id', title: 'Aksi', name: 'action', orderable: false, searchable: false,
              "render": function ( data, type, row, meta ) {
                let updateRoute;
                updateRoute = `/admin/masterdata/championship/update/${data}`;

                return `
                  <div>
                    <a href="${updateRoute}" class="btn btn-sm unrounded btn-primary">
                      <small>Edit Kejuaraan</small>
                    </a>
                  </div>

                  <div class="mt-2">
                    <button
                      data-id="${data}"
                      data-name="${row.name}"
                      class="btn btn-sm btn-danger unrounded delete"
                    >
                      <small>Hapus Kejuaraan</small>
                    </button>
                  </div>
                `;
              }
            }
          ]
        });
      });
    })
  </script>
@endsection
