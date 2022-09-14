@extends('layouts.admin.master')

@section('content')
  <div id="socmed_account" class="content">
    <div class="title-container">
      <h4 class="text-primary">
        Akun Sosmed
      </h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <a href="{{ route('admin.masterdata.socmed-account.create') }}" class="btn btn-primary btn-sm unrounded">
          Tambah Akun Sosmed&nbsp;
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

      const deleteURL = `/admin/masterdata/socmed-account/delete`
      const formData = new FormData()
      formData.append('id', id)
      formData.append('_token', csrfToken)

      swal({
        text: `Ingin menghapus akun sosmed ${name}?`,
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
                text: `Sosmed ${name} berhasil dihapus`
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
              url: "/api/socmed-account/listDatatable"
            },
            columns: [
              {data: 'created_by', title: 'Pemilik Akun', name: 'created_by',
                "render": function ( data, type, row, meta ) {
                  if (data === null) {
                    return '-'
                  } else {
                    return data.name
                  }
                }
              },
              {data: 'socmed', title: 'Sosmed', name: 'socmed',
                "render": function ( data, type, row, meta ) {
                  return data.name
                }
              },
              {data: 'federation', title: 'Federasi', name: 'federation',
                "render": function ( data, type, row, meta ) {
                  return data.abbreviation
                }
              },
              {data: 'account_profile', title: 'Nama Profile', name: 'account_profile'},
              {data: 'username', title: 'username', name: 'username'},
              {data: 'password', title: 'password', name: 'password'},

              {data: 'id', title: 'Aksi', orderable: false, searchable: false,
                "render": function ( data, type, row, meta ) {
                  let updateRoute
                  updateRoute = `/admin/masterdata/socmed-account/update/${data}`

                  return `
                    <a href="${updateRoute}" class="btn btn-sm unrounded btn-primary">
                      <small>Edit Akun Sosmed</small>
                    </a>

                    <button
                      data-id="${data}"
                      data-name="${row.socmed.name}"
                      class="btn btn-sm btn-danger unrounded delete"
                    >
                      <small>Hapus Akun Sosmed</small>
                    </button>
                  `;
                }
              }
            ]
        });
      });
    })
  </script>
@endsection