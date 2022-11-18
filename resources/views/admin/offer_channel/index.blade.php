@extends('layouts.admin.master')

@section('content')
  <div id="channel" class="content">
    <div class="title-container">
      <h4 class="text-primary">
        Channel
      </h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <a href="{{ route('admin.offer.masterdata.channel.create') }}" class="btn btn-primary btn-sm unrounded">
          Tambah Channel&nbsp;
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

      const deleteURL = `/admin/offer/masterdata/channel/delete`;
      const formData = new FormData();
      formData.append('id', id);
      formData.append('_token', csrfToken);

      swal({
        text: `Ingin menghapus channel ${name}?`,
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
                text: `Channel ${name} berhasil dihapus`
              });
            } else {
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
            url: "/api/offer/channel/listDatatable"
          },
          columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', title: 'No',  orderable: false, searchable: false },
            { data: 'name', title: 'Nama Channel', name: 'name' },
            { data: 'code', title: 'Code', name: 'code' },
            { data: 'user', title: 'User', name: 'user',
              "render": function ( data, type, row, meta ) {
                return data.name || '-'
              }
            },
            {data: 'id', title: 'Aksi', name: 'action', orderable: false, searchable: false,
              "render": function ( data, type, row, meta ) {
                let updateRoute;
                updateRoute = `/admin/offer/masterdata/channel/update/${data}`;

                return `
                  <div>
                    <a href="${updateRoute}" class="btn btn-sm unrounded btn-primary">
                      <small>Edit Channel</small>
                    </a>
                  </div>

                  <div class="mt-2">
                    <button
                      data-id="${data}"
                      data-name="${row.name}"
                      class="btn btn-sm btn-danger unrounded delete"
                    >
                      <small>Hapus Channel</small>
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
