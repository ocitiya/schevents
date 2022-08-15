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
        @if ($federation_id != null)
          Jadwal Pertandingan di Federasi: {{ $federation_name }}
        @else
          Jadwal Pertandingan
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
        @if ($federation_id != null)
          <a
            href="{{ route('admin.match-schedule.create', ["federation_id" => $federation_id]) }}"
            class="btn btn-primary btn-sm unrounded"
          >
            Create New&nbsp;
            <i class="fa-solid fa-plus"></i>
          </a>
        @else
          <a
            href="{{ route('admin.match-schedule.create') }}"
            class="btn btn-primary btn-sm unrounded"
          >
            Create New&nbsp;
            <i class="fa-solid fa-plus"></i>
          </a>
        @endif
      </div>

      <ul class="nav nav-tabs" id="myTab" role="tablist">      
        <li class="nav-item" role="presentation">
          <button class="nav-link tab-item" type="button" role="tab" data-state="upcoming">
            Akan Datang
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link tab-item" type="button" role="tab" data-state="this-week">
            Minggu Ini
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link tab-item active" type="button" role="tab" data-state="today">
            Hari Ini
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link tab-item" type="button" role="tab" data-state="live">
            Sedang Bermain
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link tab-item" type="button" role="tab" data-state="have-played">
            Sudah Bermain
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link tab-item" type="button" role="tab" data-state="last-week">
            Minggu Lalu
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link tab-item" type="button" role="tab" data-state="old-data">
            Data Lama
          </button>
        </li>
      </ul>

      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" role="tabpanel" tabindex="0">
          <div class="data-center">
            <div id="schedule-items" style="width: 100%">
              <table id="datatable" class="table table-bordered"></table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    let table = null
    const data = {
      state: "today",
      federation_id: "<?php echo isset($federation_id) ? $federation_id : null ?>"
    }

    const getData = (params) => {
      return data[params]
    }

    document.addEventListener('DOMContentLoaded', async function () {
      $('.tab-item').on('click', function (e) {
        e.preventDefault()

        data.state = $(this).attr('data-state')
        table.ajax.reload()

        $('.tab-item').each(function (i, obj) {
          if ($(obj).attr('data-state') === data.state) {
            $(obj).addClass('active')
          } else {
            $(obj).removeClass('active')
          }
        })
      })

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
            data: function (data) {
              data.state = getData('state'),
              data.federation_id = getData('federation_id')
            }
          },
          columns: [
            {data: 'school1', title: 'Nama State', name: 'state1',
              "render": function ( data, type, row, meta ) {
                return data.county.name
              }
            },
            {data: 'school1', title: 'Club 1', name: 'school1',
              "render": function ( data, type, row, meta ) {
                if (data !== null) {
                  if (row.score1 !== null) {
                    return `${data.name} <span class="text-bg-success">(${row.score1})</span>`
                  } else {
                    return data.name
                  }
                } else {
                  return 'Unknown School'
                }
              }
            },
            {data: 'school2', title: 'Nama State 2', name: 'state2',
              "render": function ( data, type, row, meta ) {
                return data.county.name
              }
            },
            {data: 'school2', title: 'Club 2', name: 'school2',
              "render": function ( data, type, row, meta ) {
                if (data !== null) {
                  if (row.score2 !== null) {
                    return `${data.name} <span class="text-bg-success">(${row.score2})</span>`
                  } else {
                    return data.name
                  }
                } else {
                  return 'Unknown School'
                }
              }
            },
            {data: 'team_type', title: 'Federasi', name: 'team_type',
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
              "render": function ( d, type, row, meta ) {
                let updateRoute = `/admin/match-schedule/update/${d}`
                if (data.federation_id !== null) {
                  updateRoute += `?federation_id=${data.federation_id}`
                }

                if (getData('state') == 'have-played') {
                  updateRoute += '&sudah-bermain'
                }


                return `
                  <a href="${updateRoute}" class="btn btn-sm unrounded btn-primary">
                    <small>Edit Pertandingan</small>
                  </a>

                  <button
                    class="btn btn-sm unrounded btn-danger delete"
                    data-id="${d}"
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