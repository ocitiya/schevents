@extends('layouts.admin.master')

@section('content')
  <div id="campaign" class="content">
    <div class="title-container">
      <h4 class="text-primary">
        Tipe Campaign
      </h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <a href="{{ route('admin.offer.masterdata.campaign.create') }}" class="btn btn-primary btn-sm unrounded">
          Tambah Tipe Campaign&nbsp;
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

      const deleteURL = `/admin/offer/masterdata/campaign/delete`;
      const formData = new FormData();
      formData.append('id', id);
      formData.append('_token', csrfToken);

      swal({
        text: `Ingin menghapus tipe campaign ${name}?`,
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
                text: `Tipe campaign ${name} berhasil dihapus`
              });
            } else {
              console.log(data.message);
              swal(data.message, { icon: 'error' });
            }
          })
        }
      });
    })

    document.addEventListener('DOMContentLoaded', async function () {
      $(function () {
        table = $('#datatable').DataTable({
          dom: '<"dt-top"if><"dt-t"rt><"dt-bottom"lp><"clear">',
          processing: true,
          serverSide: true,
          ajax: {
            url: "/api/offer/campaign/listDatatable"
          },
          columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', title: 'No',  orderable: false, searchable: false },
            { data: 'name', title: 'Campaign', name: 'campaign' },
            { data: 'image', title: 'Image', name: 'image', 
              "render": function ( data, type, row, meta ) {
                if (data === null) {
                  return `
                    <img src="/images/no-logo-1.png" style="width: 75px" class="mb-3">
                  `
                } else {
                  return `
                    <img src="/storage/campaign/image/${data}" style="width: 75px" class="mb-3">
                  `
                }
              }
            },
            {data: 'id', title: 'Aksi', name: 'action', orderable: false, searchable: false,
              "render": function ( data, type, row, meta ) {
                let updateRoute;
                updateRoute = `/admin/offer/masterdata/campaign/update/${data}`;

                return `
                  <div>
                    <a href="${updateRoute}" class="btn btn-sm unrounded btn-primary">
                      <small>Edit Tipe Campaign</small>
                    </a>
                  </div>

                  <div class="mt-2">
                    <button
                      data-id="${data}"
                      data-name="${row.name}"
                      class="btn btn-sm btn-danger unrounded delete"
                    >
                      <small>Hapus Tipe Campaign</small>
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
