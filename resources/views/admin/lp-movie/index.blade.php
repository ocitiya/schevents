@extends('layouts.admin.master')

@section('content')
  <div id="lp" class="content">
    <div class="title-container">
      <h4 class="text-primary">
        LP Movie
      </h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <a href="{{ route('admin.lp.movie.create') }}" class="btn btn-primary btn-sm unrounded">
          Tambah LP Movie&nbsp;
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

      const deleteURL = `/admin/lp/movie/delete`;
      const formData = new FormData();
      formData.append('id', id);
      formData.append('_token', csrfToken);

      swal({
        text: `Ingin menghapus LP movie ${name}?`,
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
                text: `Tipe Lp ${name} berhasil dihapus`
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
          url: "/api/lp/movie/listDatatable"
          },
          columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', title: 'No',  orderable: false, searchable: false },
            { data: 'type', name: 'type', title: 'Nama LP',
              "render": function ( data, type, row, meta ) {
                return data.name || '-';
              }
            },
            { data: 'channel', name: 'channel', title: 'Channel',
              "render": function ( data, type, row, meta ) {
                return data.name || '-';
              }
            },
            {data: 'id', title: 'Aksi', name: 'action', orderable: false, searchable: false,
              "render": function ( data, type, row, meta ) {
                let updateRoute;
                updateRoute = `/admin/lp/movie/update/${data}`;

                return `
                  <div>
                    <a href="${updateRoute}" class="btn btn-sm unrounded btn-primary">
                      <small>Edit LP Movie</small>
                    </a>
                  </div>

                  <div class="mt-2">
                    <button
                      data-id="${data}"
                      data-name="${row.type.name}"
                      class="btn btn-sm btn-danger unrounded delete"
                    >
                      <small>Hapus LP Movie</small>
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
