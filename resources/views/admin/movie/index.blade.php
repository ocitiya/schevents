@extends('layouts.admin.master')

@section('content')
  <div id="sport_types" class="content">
    <div class="title-container">
      <h4 class="text-primary">
        Film
      </h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <a href="{{ route('admin.movie.create') }}" class="btn btn-primary btn-sm unrounded">
          Tambah Film&nbsp;
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

      const deleteURL = `/admin/movie/delete`
      const formData = new FormData()
      formData.append('id', id)
      formData.append('_token', csrfToken)

      swal({
        text: `Ingin menghapus film ${name}?`,
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
                text: `Film ${name} berhasil dihapus`
              })
            } else {
              console.log(data.message)
              swal(data.message, { icon: 'error' });
            }
          })
        }
      });
    })

    const windowShare = (shareURL) => {
      window.open(shareURL, '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');
    }

    $('#datatable').on('click', '.share-to-fb', function () {
      const shareURL = $(this).attr('data-share')
      windowShare(shareURL)
    });

    $('#datatable').on('click', '.share-to-twitter', function () {
      const shareURL = $(this).attr('data-share')
      windowShare(shareURL)
    });

    document.addEventListener('DOMContentLoaded', async function () {
      $(function () {
        table = $('#datatable').DataTable({
          dom: '<"dt-top"if><"dt-t"rt><"dt-bottom"lp><"clear">',
          processing: true,
          serverSide: true,
          ajax: {
            url: "/api/movie/listDatatable"
          },
          columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', title: 'No',  orderable: false, searchable: false },
            {data: 'name', title: 'Nama', name: 'name'},
            {data: 'movie_type', title: 'Jenis Film', name: 'movie_type', 
              "render": function ( data, type, row, meta ) {
                return data.name;
              }
            },
            {data: 'release_date', title: 'Tanggal Rilis', name: 'release_date', 
              "render": function ( data, type, row, meta ) {
                let release_date = moment.utc(data).local();
                release_date = release_date.format('ddd, D MMMM Y');

                const zone_name = moment.tz.guess();
                const timezone = moment.tz(zone_name).zoneAbbr();

                return `${release_date} ${timezone}`;
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
                    <img src="/storage/movie/image/${data}" style="width: 75px" class="mb-3">
                  `
                }
              }
            },
            {data: 'id', title: 'Aksi', name: 'action', orderable: false, searchable: false,
              "render": function ( data, type, row, meta ) {
                let updateRoute
                updateRoute = `/admin/movie/update/${data}`

                return `
                  <a href="${updateRoute}" class="btn btn-sm unrounded btn-primary">
                    <small>Edit Film</small>
                  </a>

                  <button
                    data-id="${data}"
                    data-name="${row.name}"
                    class="btn btn-sm btn-danger unrounded delete"
                  >
                    <small>Hapus Film</small>
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
