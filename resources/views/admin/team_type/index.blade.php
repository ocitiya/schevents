@extends('layouts.admin.master')

@section('content')
  <div id="schools" class="content">
    <div class="title-container">
      <h4 class="text-primary">
        Tipe Tim
      </h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <a href="{{ route('admin.masterdata.team_type.create') }}" class="btn btn-primary btn-sm unrounded">
          Tambah Tipe Tim&nbsp;
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

        const deleteURL = `/admin/masterdata/team_type/delete`
        const formData = new FormData()
        formData.append('id', id)
        formData.append('_token', csrfToken)

        swal({
          text: `Ingin menghapus tipe ${name}?`,
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
          dom: '<"dt-top"if><"dt-t"rt><"dt-bottom"lp><"clear">',
          processing: true,
          serverSide: true,
          ajax: {
            url: "/api/team_type/listDatatable"
          },
          columns: [
            {data: 'name', title: 'Name', name: 'name'},
            {data: 'id', title: 'Aksi', orderable: false, searchable: false,
              "render": function ( data, type, row, meta ) {
                const updateRoute = `/admin/masterdata/team_type/update/${data}`

                return `
                  <a href="${updateRoute}" class="btn btn-sm unrounded btn-primary">
                    <small>Edit Tipe</small>
                  </a>

                  <button
                    data-id="${data}"
                    data-name="${row.name}"
                    class="btn btn-sm btn-danger unrounded delete"
                  >
                    <small>Hapus Tipe</small>
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