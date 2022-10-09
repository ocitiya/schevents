@extends('layouts.admin.master')

@section('content')
  <div id="sport_types" class="content">
    <div class="title-container">
      <h4 class="text-primary">
        App Follow Us
      </h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <a href="{{ route('admin.app.follow_us.create') }}" class="btn btn-primary btn-sm unrounded">
          Tambah Data&nbsp;
          <i class="fa-solid fa-plus"></i>
        </a>
      </div>

      <div class="data-center">
        <div id="type-items">
          <table id="datatable" class="table table-bordered"></table>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    $('#datatable').on('click', '.delete', function () {
      const id = $(this).attr('data-id')
      const type = $(this).attr('data-type')

      const deleteURL = `/admin/app/follow_us/delete`
      const formData = new FormData()
      formData.append('id', id)
      formData.append('_token', csrfToken)

      swal({
        text: `Ingin menghapus data ${type}?`,
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
                text: `Data ${type} berhasil dihapus`
              })
            } else {
              console.log(data.message)
              swal(data.message, { icon: 'error' });
            }
          })
        }
      });
    })

    document.addEventListener('DOMContentLoaded', async function () {
      $(function () {
        table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
              url: "/api/app/follow_us/listDatatable",
              method: 'GET',
            },
            columns: [
              {data: 'type', title: 'Tipe', name: 'type' },
              {data: 'link', title: 'Link', name: 'link' },
              {data: 'logo', title: 'Gambar', name: 'logo',
                "render": function ( data, type, row, meta ) {
                  return `
                    <a href="/storage/app_follow_us/image/${data}" target="_blank">
                      <img src="/storage/app_follow_us/image/${data}" style="width: 75px" class="mb-3">
                    </a>
                  `
                }
              },
              {data: 'id', title: 'Aksi', orderable: false, searchable: false,
                "render": function ( data, type, row, meta ) {
                  const updateRoute = `/admin/app/follow_us/update/${data}`

                  return `
                    <a href="${updateRoute}" class="btn btn-sm unrounded btn-primary">
                      <small>Edit Data</small>
                    </a>

                    <button
                      data-id="${data}"
                      data-type="${row.type}"
                      class="btn btn-sm btn-danger unrounded delete"
                    >
                      <small>Hapus Data</small>
                    </button>
                  `;
                }
              },
            ]
        });
      });
    })
  </script>
@endsection