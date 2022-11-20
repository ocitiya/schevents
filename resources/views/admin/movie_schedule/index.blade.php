@extends('layouts.admin.master')

@section('content')
  <div id="sport_types" class="content">
    <div class="title-container">
      <h4 class="text-primary">
        Jadwal Film
      </h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <a href="{{ route('admin.movie.schedule.create') }}" class="btn btn-primary btn-sm unrounded">
          Tambah Jadwal Film&nbsp;
          <i class="fa-solid fa-plus"></i>
        </a>
      </div>

      <ul class="nav nav-tabs" id="myTab" role="tablist">      
        <li class="nav-item" role="presentation">
          <button class="nav-link tab-item active" type="button" role="tab" data-state="streaming">
            Streaming
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link tab-item" type="button" role="tab" data-state="upcoming">
            Akan Datang
          </button>
        </li>
      </ul>

      <div class="data-center mt-3">
        <div id="type-items">
          <table id="datatable" class="table table-bordered" style="font-size: small"></table>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    let table;

    const data = { state: "streaming" };

    const getData = (params) => {
      return data[params]
    }

    $('#datatable').on('click', '.delete', function () {
      const id = $(this).attr('data-id');
      const name = $(this).attr('data-name');
      let show_date = $(this).attr('data-show_date');
      show_date = moment(show_date).format('D MMMM Y');

      const deleteURL = `/admin/movie/schedule/delete`;
      const formData = new FormData();
      formData.append('id', id);
      formData.append('_token', csrfToken);

      swal({
        text: `Ingin menghapus jadwal film ${name} di tanggal ${show_date}?`,
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
              table.ajax.reload();
              swal({
                title: 'Deleted',
                icon: 'success',
                text: `Jadwal film ${name} di tanggal ${show_date} berhasil dihapus`
              });
            } else {
              console.log(data.message);
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
      });
    });

    document.addEventListener('DOMContentLoaded', async function () {
      $(function () {
        table = $('#datatable').DataTable({
          dom: '<"dt-top"if><"dt-t"rt><"dt-bottom"lp><"clear">',
          processing: true,
          serverSide: true,
          ajax: {
            url: "/api/movie/schedule/listDatatable",
            method: 'POST',
            data: function (data) {
              data.state = getData('state');
            }
          },
          columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', title: 'No',  orderable: false, searchable: false },
            {data: 'movie', title: 'Film', name: 'movie',
              "render": function (data, type, row, meta) {
                return data.name;
              }
            },
            {data: 'campaign', title: 'Campaign', name: 'campaign', 
              "render": function ( data, type, row, meta ) {
                return data === null ? '-' : data.name;
              }
            },
            {data: 'banner', title: 'Banner', name: 'banner', 
              "render": function ( data, type, row, meta ) {
                return data === null ? '-' : data.name;
              }
            },
            {data: 'channel', title: 'Channel', name: 'channel', 
              "render": function ( data, type, row, meta ) {
                return data === null ? '-' : data.name;
              }
            },
            {data: 'created_at', title: 'Dibuat', orderable: false, searchable: false,
              className: 'no-wrap',
              "render": function (data, type, row, meta) {
                const timezone = moment().tz(moment.tz.guess()).format('z')
                let created_at = row.created_at;

                if (created_at === null) {
                  created_at = '-';
                } else {
                  const date = moment.utc(created_at).local().format('D MMM YYYY');
                  const time = moment.utc(created_at).local().format('H:mm:ss');

                  created_at = `${date} <br> ${time} ${timezone}`;
                }

                const name = row.created_name !== null ? row.created_name.name : '-';

                return `
                  ${name}<br>
                  ${created_at}
                `;
              }
            },
            {data: 'updated_at', title: 'Diubah', orderable: false, searchable: false,
              className: 'no-wrap',
              "render": function (data, type, row, meta) {
                const timezone = moment().tz(moment.tz.guess()).format('z')
                let updated_at = row.updated_at;

                if (updated_at === null) {
                  updated_at = '-';
                } else {
                  const date = moment.utc(updated_at).local().format('D MMM YYYY');
                  const time = moment.utc(updated_at).local().format('H:mm:ss');

                  updated_at = `${date} <br> ${time} ${timezone}`;
                }

                const name = row.updated_name !== null ? row.updated_name.name : '-';

                return `
                  ${name}<br>
                  ${updated_at}
                `;
              }
            },
            {data: 'id', title: 'Aksi', name: 'action', orderable: false, searchable: false,
              "render": function ( data, type, row, meta ) {
                let updateRoute;
                updateRoute = `/admin/movie/schedule/update/${data}`;

                return `
                  <div>
                    <a href="${updateRoute}" class="btn btn-sm unrounded btn-primary">
                      <small>Edit Jadwal Film</small>
                    </a>
                  </div>

                  <div class="mt-2">
                    <button
                      data-id="${data}"
                      data-name="${row.movie.name}"
                      data-show_date="${row.release_date}"
                      class="btn btn-sm btn-danger unrounded delete"
                    >
                      <small>Hapus Jadwal Film</small>
                    </button>
                  </div>
                `;
              }
            },
            {data: 'offer', title: 'Share', orderable: false, searchable: false, className: 'd-inline-flex',
              "render": function ( data, type, row, meta ) {
                if (data === null) {
                  return '-';
                } else {
                  let release_date = moment.utc(row.release_date).local();
                  release_date = release_date.format('ddd, D MMMM Y');

                  const zone_name = moment.tz.guess();
                  const timezone = moment.tz(zone_name).zoneAbbr();
                  const link = data.short_link;
                  const title = row.movie.name;
                  const description = row.movie.description;

                  const types = [];
                  row.movie.movie_type.map(item => types.push(item.movie_type.name));
                  const genre = types.join(', ');

                  let message = `Live Streaming Movie - ${title}\n\nDescription\n\tRelease Date: ${release_date}\n\tGenre: ${genre}\n\tLink: ${link}\n\tSinopsis: ${description || '-'}`;

                  const text = encodeURIComponent(message);
                  const shareURLTW = `https://twitter.com/intent/tweet?text=${text}`;

                  return `
                    <button class="share-to-fb btn btn-sm" data-share="${row.link}">
                      <img src="/images/fb-logo-2.png" alt="Facebook Logo" style="height: 20px; width: 20px">
                    </button>

                    <br />

                    <button class="share-to-twitter btn btn-sm" data-share="${shareURLTW}">
                      <img src="/images/twitter-logo-2.png" alt="Twitter Logo" style="height: 20px; width: 20px">
                    </button>
                  `;
                }
              }
            },
          ]
        });
      });
    })
  </script>
@endsection
