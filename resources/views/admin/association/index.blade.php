@extends('layouts.admin.master')

@section('content')
  <div id="association" class="content">
    <div class="title-container">
      <h4 class="text-primary">
        Asosiasi
      </h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <a href="{{ route('admin.masterdata.association.create') }}" class="btn btn-primary btn-sm unrounded">
          Tambah Asosiasi&nbsp;
          <i class="fa-solid fa-plus"></i>
        </a>
        
        <div>
          <form action="" autocomplete="off" method="POST">
            <input class="form-control" placeholder="Search" type="text" id="search">
          </form>
        </div>
      </div>

      <div class="data-center">
        <table id="datatable" class="table table-bordered"></table>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    let table = null;
    document.addEventListener('DOMContentLoaded', async function () {
      $('#datatable').on('click', '.delete', function () {
        const id = $(this).attr('data-id')
        const name = $(this).attr('data-name')

        const deleteURL = `/admin/masterdata/association/delete`
        const formData = new FormData()
        formData.append('id', id)
        formData.append('_token', csrfToken)

        swal({
          text: `Ingin menghapus asosiasi ${name}?`,
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
                  text: `Tipe ${name} berhasil dihapus`
                })
              } else {
                console.log(data.message)
                swal(data.message, { icon: 'error' });
              }
            })
          }
        });
      })

      $(function () {
        table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
              url: "/api/association/listDatatable"
            },
            columns: [
              {data: 'name', title: 'Name', name: 'name'},
              {data: 'abbreviation', title: 'Abbreviation', name: 'abbreviation'},
              {data: 'federation', title: 'Federasi', name: 'federation',
                render: function ( data, type, row, meta ) {
                  return data.abbreviation
                } 
              },
              {data: 'logo', title: 'Logo', name: 'logo',
                render: function ( data, type, row, meta ) {
                  return `
                    <img src="/storage/association/logo/${data}" style="width: 75px" class="mb-3">
                  `
                }
              },
              {data: 'id', title: 'Aksi', orderable: false, searchable: false,
                render: function ( data, type, row, meta ) {
                  const updateRoute = `/admin/masterdata/association/update/${data}`

                  return `
                    <a href="${updateRoute}" class="btn btn-sm unrounded btn-primary">
                      <small>Edit Asosiasi</small>
                    </a>

                    <button
                      data-id="${data}"
                      data-name="${row.name}"
                      class="btn btn-sm btn-danger unrounded delete"
                    >
                      <small>Hapus Asosiasi</small>
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