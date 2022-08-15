@extends('layouts.admin.master')

@section('content')
  <div id="sport_types" class="content">
    <div class="title-container">
      <h4 class="text-primary">
        @if ($default_federation != null)
          Olahraga dalam federasi: {{ $federation_name }}
        @else
          Olahraga
        @endif
      </h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        @if ($default_federation != null)
          <a href="{{ route('admin.sport.type.create')."?federation_id={$default_federation}" }}" class="btn btn-primary btn-sm unrounded">
            Tambah Olahraga&nbsp;
            <i class="fa-solid fa-plus"></i>
          </a>
        @else
          <a href="{{ route('admin.sport.type.create') }}" class="btn btn-primary btn-sm unrounded">
            Tambah Olahraga&nbsp;
            <i class="fa-solid fa-plus"></i>
          </a>
        @endif
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
    const isFederationDefault = "<?php echo $default_federation ? 1 : 0 ?>";

    const data = {
      federation_id: "<?php echo $default_federation ?>"
    };

    const getData = (params) => {
      return data[params]
    };

    $('#datatable').on('click', '.delete', function () {
      const id = $(this).attr('data-id')
      const name = $(this).attr('data-name')

      const deleteURL = `/admin/sport/type/delete`
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
                text: `Olahraga ${name} berhasil dihapus`
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
              url: "/api/sport-type/listDatatable",
              method: 'POST',
              data: function (data) {
                data.federation_id = getData('federation_id')
              }
            },
            columns: [
              {data: 'name', title: 'Name', name: 'name'},
              {data: 'federation', title: 'Singkatan Federasi', name: 'federation',
                "render": function ( data, type, row, meta ) {
                  return data.abbreviation
                }
              },
              {data: 'image', title: 'Gambar', name: 'image',
                "render": function ( data, type, row, meta ) {
                  return `
                    <img src="/storage/sport/image/${data}" style="width: 75px" class="mb-3">
                  `
                }
              },
              {data: 'id', title: 'Aksi', orderable: false, searchable: false,
                "render": function ( data, type, row, meta ) {
                  let updateRoute
                  if (isFederationDefault == 0) {
                    updateRoute = `/admin/sport/type/update/${data}`
                  } else {
                    updateRoute = `/admin/sport/type/update/${data}?federation_id=${data.federation_id}`
                  }

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