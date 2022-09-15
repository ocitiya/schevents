@extends('layouts.admin.master')

@section('content')
  <div id="schools" class="content">
    <div class="title-container">
      <h4 class="text-primary">
        Lapangan / Stadion
      </h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <a href="{{ route('admin.masterdata.stadium.create') }}" class="btn btn-primary btn-sm unrounded">
          Tambah Lapangan / Stadion&nbsp;
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

        const deleteURL = `/admin/masterdata/stadium/delete`
        const formData = new FormData()
        formData.append('id', id)
        formData.append('_token', csrfToken)

        swal({
          text: `Ingin menghapus lapangan / stadion ${name}?`,
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
              url: "/api/stadium/listDatatable"
            },
            columns: [
              {data: 'name', title: 'Nama', name: 'name'},
              {data: 'nickname', title: 'Nickname', name: 'nickname'},
              {data: 'address', title: 'Alamat', name: 'address'},
              {data: 'county', title: 'State', name: 'county',
                "render": function ( data, type, row, meta ) {
                  return data.name
                }
              },
              {data: 'municipality', title: 'Kota', name: 'municipality',
                "render": function ( data, type, row, meta ) {
                  return data.name
                }
              },
              {data: 'image', title: 'Gambar', name: 'image',
                "render": function ( data, type, row, meta ) {
                  if (data === null) {
                    return `
                      <img src="/images/no-logo-1.png" style="width: 75px" class="mb-3">
                    `
                  } else {
                    return `
                      <img src="/storage/stadium/image/${data}" style="width: 75px" class="mb-3">
                    `
                  }
                }
              },
              {data: 'id', title: 'Aksi', orderable: false, searchable: false,
                "render": function ( data, type, row, meta ) {
                  const updateRoute = `/admin/masterdata/stadium/update/${data}`

                  let deleteButton = '';
                  if (['admin', 'superadmin'].includes(role)) {
                    deleteButton = `
                      <button
                        data-id="${data}"
                        data-name="${row.name}"
                        class="btn btn-sm btn-danger unrounded delete"
                      >
                        <small>Hapus Data</small>
                      </button>
                    `;
                  }
                  
                  return `
                    <a href="${updateRoute}" class="btn btn-sm unrounded btn-primary">
                      <small>Edit Data</small>
                    </a>

                    ${deleteButton}
                  `;
                }
              },
            ]
        });

      });
    })
  </script>
@endsection