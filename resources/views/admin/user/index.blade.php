@extends('layouts.admin.master')

@section('content')
  <div id="user" class="content">
    <div class="title-container">
      <h4 class="text-primary">
        User
      </h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <a href="{{ route('admin.user.create') }}" class="btn btn-primary btn-sm unrounded">
          Tambah User&nbsp;
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

      const deleteURL = `/admin/user/delete`
      const formData = new FormData()
      formData.append('id', id)
      formData.append('_token', csrfToken)

      swal({
        text: `Ingin menghapus user ${name}?`,
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
                text: `User ${name} berhasil dihapus`
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
              url: "/api/user/listDatatable"
            },
            columns: [
              {data: 'user', title: 'Nama', name: 'user', 
                "render": function ( data, type, row, meta ) {
                  return data.name
                }
              },
              {data: 'user', title: 'username', name: 'user',
                "render": function ( data, type, row, meta ) {
                  return data.username
                }
              },
              {data: 'level', title: 'Role', name: 'level'},
              {data: 'id', title: 'Aksi', orderable: false, searchable: false,
                "render": function ( data, type, row, meta ) {
                  updateRoute = `/admin/user/update/${data}`

                  if (row.level !== 'superadmin') {
                    return `
                    <a href="${updateRoute}" class="btn btn-sm unrounded btn-primary">
                      <small>Edit User</small>
                    </a>

                    <button
                      data-id="${data}"
                      data-name="${row.user.name}"
                      class="btn btn-sm btn-danger unrounded delete"
                    >
                      <small>Hapus User</small>
                    </button>
                  `;
                  } else {
                    return '-';
                  }
                }
              }
            ]
        });
      });
    })
  </script>
@endsection