@extends('layouts.admin.master')

@section('content')
  <div id="sport_types" class="content">
    <div class="title-container">
      <h4 class="text-primary">
        @if ($default_federation != null)
        Link Stream dalam federasi: {{ $federation_name }}
        @else
          Link Stream
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
            Tambah Link Stream&nbsp;
            <i class="fa-solid fa-plus"></i>
          </a>
        @else
          <a href="{{ route('admin.sport.type.create') }}" class="btn btn-primary btn-sm unrounded">
            Tambah Link Stream&nbsp;
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
        text: `Ingin menghapus Link Stream ${name}?`,
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
                text: `Link Stream ${name} berhasil dihapus`
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
              {data: 'name', title: 'Name', name: 'name',
                "render": function ( data, type, row, meta ) {
                  if (data === null) {
                     return row.sport === null ? 'Not Found' : row.sport.name
                  } else {
                    return data
                  }
                }
              },
              {data: 'championship', title: 'Singkatan Kejuaraan', name: 'championship',
                "render": function ( data, type, row, meta ) {
                  if (data === null) {
                    return '-';
                  } else {
                    return data.abbreviation;
                  } 
                }
              },
              {data: 'image', title: 'Banner', name: 'banner',
                "render": function ( data, type, row, meta ) {
                  if (data === null) {
                    return `
                      <img src="/images/no-logo-1.png" style="width: 75px" class="mb-3">
                    `
                  } else {
                    return `
                      <img src="/storage/link_stream/image/${data}" style="width: 75px" class="mb-3">
                    `
                  }
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

                  let name = row.name;
                  if (row.name === null) {
                     name = row.sport === null ? 'Not Found' : row.sport.name
                  }

                  if (row.championship !== null) {
                    name += ` - ${row.championship.abbreviation}`;
                  } else if (row.federation !== null) {
                    name += ` - ${row.federation.abbreviation}`
                  }
            
                  return `
                    <a href="${updateRoute}" class="btn btn-sm unrounded btn-primary">
                      <small>Edit Link Stream</small>
                    </a>

                    <button
                      data-id="${data}"
                      data-name="${name}"
                      class="btn btn-sm btn-danger unrounded delete"
                    >
                      <small>Hapus Link Stream</small>
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