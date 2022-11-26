@extends('layouts.admin.master')

@section('content')
  <div id="offer" class="content">
    <div class="title-container">
      <h4 class="text-primary">
        Promosi
      </h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <a href="{{ route('admin.offer.create') }}" class="btn btn-primary btn-sm unrounded">
          Tambah Promosi&nbsp;
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
      const name = $(this).attr('data-campaign');

      const deleteURL = `/admin/offer/delete`;
      const formData = new FormData();
      formData.append('id', id);
      formData.append('_token', csrfToken);

      swal({
        text: `Ingin menghapus promosi ${name}?`,
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
                text: `Promosi ${name} berhasil dihapus`
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
            url: "/api/offer/listDatatable"
          },
          columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', title: 'No',  orderable: false, searchable: false },
            { data: 'campaign', title: 'Nama Campaign', name: 'campaign',
              "render": function ( data, type, row, meta ) {
                return data.name || '-'
              }
            },
            { data: 'banner', title: 'Nama Banner', name: 'banner',
              "render": function ( data, type, row, meta ) {
                return data.name || '-'
              }
            },
            { data: 'channel', title: 'Channel', name: 'channel',
              "render": function ( data, type, row, meta ) {
                return data.name || '-'
              }
            },
            {data: 'id', title: 'Aksi', name: 'action', orderable: false, searchable: false,
              "render": function ( data, type, row, meta ) {
                const updateRoute = `/admin/offer/update/${data}`;
                const detailRoute = `/admin/offer/detail/${data}`;

                if (['user'].includes(role)) {
                  return `
                    <div>
                      <a href="${detailRoute}" class="btn btn-sm unrounded btn-primary">
                        <small>Detail Promosi</small>
                      </a>
                    </div>
                  `;
                } else if (['admin', 'superadmin'].includes(role)) {
                  return `
                    <div>
                      <a href="${detailRoute}" class="btn btn-sm unrounded btn-primary">
                        <small>Detail Promosi</small>
                      </a>
                    </div>

                    <div class="mt-2">
                      <a href="${updateRoute}" class="btn btn-sm unrounded btn-primary">
                        <small>Edit Promosi</small>
                      </a>
                    </div>

                    <div class="mt-2">
                      <button
                        data-id="${data}"
                        data-campaign="${row.campaign.name}"
                        class="btn btn-sm btn-danger unrounded delete"
                      >
                        <small>Hapus Promosi</small>
                      </button>
                    </div>
                  `;
                }
              }
            }
          ]
        });
      });
    })
  </script>
@endsection
