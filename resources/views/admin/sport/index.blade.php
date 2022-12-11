@extends('layouts.admin.master')

@section('content')
  <div id="sport_types" class="content">
    <div class="title-container">
      <h4 class="text-primary">
        Tipe Olahraga
      </h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <a href="{{ route('admin.sport.create') }}" class="btn btn-primary btn-sm unrounded">
          Tambah Olahraga&nbsp;
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
      const name = $(this).attr('data-name')

      const deleteURL = `/admin/sport/delete`
      const formData = new FormData()
      formData.append('id', id)
      formData.append('_token', csrfToken)

      swal({
        text: `Ingin menghapus olahraga ${name}?`,
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
                text: `Tipe olahraga ${name} berhasil dihapus`
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
          dom: '<"dt-top"if><"dt-t"rt><"dt-bottom"lp><"clear">',
          processing: true,
          serverSide: true,
          ajax: {
            url: "/api/sport/listDatatable"
          },
          columns: [
            {data: 'name', title: 'Name', name: 'name'},
            {data: 'image', title: 'Gambar', name: 'image',
              "render": function ( data, type, row, meta ) {
                if (data === null) {
                  return `
                    <img src="/images/no-logo-1.png" style="width: 75px" class="mb-3">
                  `
                } else {
                  return `
                    <img src="/storage/sport_type/image/${data}" style="width: 75px" class="mb-3">
                  `
                }
              }
            },
            {data: 'id', title: 'Aksi', orderable: false, searchable: false,
              "render": function ( data, type, row, meta ) {
                let updateRoute
                updateRoute = `/admin/sport/update/${data}`

                return `
                  <a href="${updateRoute}" class="btn btn-sm unrounded btn-primary">
                    <small>Edit Olahraga</small>
                  </a>

                  <button
                    data-id="${data}"
                    data-name="${row.name}"
                    class="btn btn-sm btn-danger unrounded delete"
                  >
                    <small>Hapus Olahraga</small>
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