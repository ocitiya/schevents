@extends('layouts.admin.master')

@section('content')
  <div id="banner" class="content">
    <div class="title-container">
      <h4 class="text-primary">
        Banner
      </h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <a href="{{ route('admin.app.banner.create') }}" class="btn btn-primary btn-sm unrounded">
          Tambah Banner&nbsp;
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

      const deleteURL = `/admin/app/banner/delete`
      const formData = new FormData()
      formData.append('id', id)
      formData.append('_token', csrfToken)

      swal({
        text: `Ingin menghapus banner`,
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
                text: `Banner berhasil dihapus`
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
              url: "/api/banner/listDatatable",
              method: 'GET'
            },
            columns: [
              {data: 'image', title: 'Gambar', name: 'image',
                "render": function ( data, type, row, meta ) {
                  return `
                    <a href="/storage/banner/image/${data}" target="_blank">
                      <img src="/storage/banner/image/${data}" style="width: 75px" class="mb-3">
                    </a>
                  `
                }
              },
              {data: 'id', title: 'Aksi', orderable: false, searchable: false,
                "render": function ( data, type, row, meta ) {
                  return `
                    <button
                      data-id="${data}"
                      class="btn btn-sm btn-danger unrounded delete"
                    >
                      <small>Hapus Banner</small>
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