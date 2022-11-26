@extends('layouts.admin.master')

@section('content')
  <div id="banner" class="content">
    <div class="title-container">
      <h4 class="text-primary">
        Tipe Banner
      </h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <a href="{{ route('admin.offer.masterdata.banner.create') }}" class="btn btn-primary btn-sm unrounded">
          Tambah Tipe Banner&nbsp;
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

      const deleteURL = `/admin/offer/masterdata/banner/delete`;
      const formData = new FormData();
      formData.append('id', id);
      formData.append('_token', csrfToken);

      swal({
        text: `Ingin menghapus tipe banner ${name}?`,
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
                text: `Tipe banner ${name} berhasil dihapus`
              });
            } else {
              console.log(data.message);
              swal(data.message, { icon: 'error' });
            }
          })
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
            url: "/api/offer/banner/listDatatable"
          },
          columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', title: 'No',  orderable: false, searchable: false },
            { data: 'campaign', title: 'Campaign', name: 'campaign',
              "render": function ( data, type, row, meta ) {
                return data.name || '-'
              }
            },
            { data: 'name', title: 'Nama Banner', name: 'name' },
            {data: 'id', title: 'Aksi', name: 'action', orderable: false, searchable: false,
              "render": function ( data, type, row, meta ) {
                let updateRoute;
                updateRoute = `/admin/offer/masterdata/banner/update/${data}`;

                return `
                  <div>
                    <a href="${updateRoute}" class="btn btn-sm unrounded btn-primary">
                      <small>Edit Tipe Banner</small>
                    </a>
                  </div>

                  <div class="mt-2">
                    <button
                      data-id="${data}"
                      data-name="${row.name}"
                      class="btn btn-sm btn-danger unrounded delete"
                    >
                      <small>Hapus Tipe Banner</small>
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
