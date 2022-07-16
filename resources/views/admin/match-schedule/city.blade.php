@extends('layouts.admin.master')

@section('content')
  <div id="match-schedule" class="content">
    @if (Session::has("success"))
      <div class="alert alert-success">
        {{ Session::get("success") }}
      </div>
    @endif

    <div class="title-container">
      <h4 class="text-primary">
        Pertandingan di kota {{ $city->name }}
      </h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <a href="{{ route('admin.match-schedule.create', ['city_id' => $city->id]) }}" class="btn btn-primary btn-sm unrounded">
          Create New&nbsp;
          <i class="fa-solid fa-plus"></i>
        </a>
      </div>

      <div class="data-center">
        <div id="schedule-items" style="width: 100%">
          <table id="datatable" class="table table-bordered"></table>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    const city_id = "<?php echo $city->id ?>"
    let table = null

    document.addEventListener('DOMContentLoaded', async function () {
      $('#datatable').on('click', '.delete', function (e) {
        e.preventDefault()

        const id = $(this).attr('data-id')
        const name = $(this).attr('data-name')

        const deleteURL = `/admin/match-schedule/delete`
        const formData = new FormData()
        formData.append('id', id)
        formData.append('_token', csrfToken)

        swal({
          text: `Ingin menghapus pertandingan ini?`,
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
                  text: `Pertandingan berhasil dihapus`
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
            url: "/api/match-schedule/listDatatable",
            method: 'POST',
            data: {
              city_id
            }
          },
          columns: [
            {data: 'county', title: 'Nama Kota', name: 'name',
              "render": function ( data, type, row, meta ) {
                return data.name
              }
            },
            {data: 'school1', title: 'Club 1', name: 'school1',
              "render": function ( data, type, row, meta ) {
                return data.name
              }
            },
            {data: 'school2', title: 'Club 2', name: 'school2',
              "render": function ( data, type, row, meta ) {
                return data.name
              }
            },
            {data: 'team_type', title: 'Tipe Tim', name: 'team_type',
              "render": function ( data, type, row, meta ) {
                return data.name
              }
            },
            {data: 'datetime', title: 'Tanggal', name: 'datetime',
              "render": function ( data, type, row, meta ) {
                const formatDate = moment.utc(data).local().format('D MMMM Y')
                return formatDate
              }
            },
            {data: 'datetime', title: 'Waktu', name: 'datetime',
              "render": function ( data, type, row, meta ) {
                const timezone = moment().tz(moment.tz.guess()).format('z')
                const formatDate = moment.utc(data).local().format('hh:mm')
                return `${formatDate} ${timezone}`
              }
            },
            {data: 'id', title: 'Aksi', orderable: false, searchable: false,
              "render": function ( data, type, row, meta ) {
                return `
                  <a href="/admin/match-schedule/update/${data}" class="btn btn-sm unrounded btn-primary">
                    <small>Edit Pertandingan</small>
                  </a>

                  <button
                    class="btn btn-sm unrounded btn-danger delete"
                    data-id="${data}"
                  >
                    <small>Hapus Pertandingan</small>
                  </button>
                `;
              }
            },
          ]
        })
      })
    })
  </script>
@endsection