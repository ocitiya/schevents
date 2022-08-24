@extends('layouts.admin.master')

@section('content')
  <div id="schools" class="content">
    <div class="title-container">
      <h4 class="text-primary">
        @if ($default_city != null)
          Sekolah di kota {{ $city_name }}
        @else
          Sekolah
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
        @if ($default_city != null)
          <a href="{{ route('admin.school.create')."?state_id={$default_state}&city_id={$default_city}" }}" class="btn btn-primary btn-sm unrounded">
            Tambah Sekolah&nbsp;
            <i class="fa-solid fa-plus"></i>
          </a>
        @else
          <a href="{{ route('admin.school.create') }}" class="btn btn-primary btn-sm unrounded">
            Tambah Sekolah&nbsp;
            <i class="fa-solid fa-plus"></i>
          </a>
        @endif
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
    const state_id = "<?php echo $default_state ?>"
    const city_id = "<?php echo $default_city ?>"
    const isCityDefault = "<?php echo $default_city ? 1 : 0 ?>"

    document.addEventListener('DOMContentLoaded', async function () {
      $('#datatable').on('click', '.delete', function () {
        const id = $(this).attr('data-id')
        const name = $(this).attr('data-name')

        const deleteURL = `/admin/school/delete`
        const formData = new FormData()
        formData.append('id', id)
        formData.append('_token', csrfToken)

        swal({
          text: `Ingin menghapus sekolah ${name}?`,
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
                  text: `Sekolah ${name} berhasil dihapus`
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
              url: "/api/school/listDatatable",
              type: 'POST',
              data: {
                city_id
              }
            },
            columns: [
              {data: 'name', title: 'Name', name: 'name'},
              {data: 'federation', title: 'Singkatan Federasi', name: 'federation',
                "render": function ( data, type, row, meta ) {
                  return `
                    ${data.abbreviation}
                  `
                }
              },
              {data: 'municipality', title: 'Kota', name: 'municipality',
                "render": function ( data, type, row, meta ) {
                  return `
                    ${data.name}
                  `
                }
              },
              {data: 'logo', title: 'Logo', name: 'logo',
                "render": function ( data, type, row, meta ) {
                  if (data === null) {
                    return `
                      <img src="/images/no-logo-1.png" style="width: 75px" class="mb-3">
                    `
                  } else {
                    return `
                      <img src="/storage/school/logo/${data}" style="width: 75px" class="mb-3">
                    `
                  }
                }
              },
              {data: 'county', title: 'State', name: 'county',
                "render": function ( data, type, row, meta ) {
                  return `
                    ${data.name}
                  `
                }
              },
              {data: 'id', title: 'Aksi', orderable: false, searchable: false,
                "render": function ( data, type, row, meta ) {
                  let updateRoute
                  if (isCityDefault) {
                    updateRoute = `/admin/school/update/${data}?state_id=${state_id}&city_id=${city_id}`
                  } else {
                    updateRoute = `/admin/school/update/${data}`
                  }

                  return `
                    <a href="${updateRoute}" class="btn btn-sm unrounded btn-primary">
                      <small>Edit Sekolah</small>
                    </a>

                    <button
                      data-id="${data}"
                      data-name="${row.name}"
                      class="btn btn-sm btn-danger unrounded delete"
                    >
                      <small>Hapus Sekolah</small>
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