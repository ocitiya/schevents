@extends('layouts.admin.master')

@section('content')
  <div id="sport_types" class="content">
    <div class="title-container">
      <h4 class="text-primary">
        Event
      </h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <a href="{{ route('admin.masterdata.event.create') }}" class="btn btn-primary btn-sm unrounded">
          Tambah Event&nbsp;
          <i class="fa-solid fa-plus"></i>
        </a>
      </div>

      <ul class="nav nav-tabs" id="myTab" role="tablist">      
        <li class="nav-item" role="presentation">
          <button class="nav-link tab-item active" type="button" role="tab" data-state="live">
            Sedang Berlangsung
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link tab-item" type="button" role="tab" data-state="upcoming">
            Akan Datang
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link tab-item" type="button" role="tab" data-state="closed">
            Sudah Selesai
          </button>
        </li>
      </ul>

      @if (inRole(["admin", "superadmin"]))
        <div class="my-3 justify-content-end delete-all-container" style="display: none">
          <button id="delete-all" class="btn btn-sm unrounded btn-danger text-end" type="button">
            <i class="fa-solid fa-trash"></i>&nbsp;
            <small>Hapus Semua</small>
          </button>
        </div>
      @endif

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

    const data = { state: "live" };

    const getData = (params) => {
      return data[params]
    }

    const toggleDeleteAllButton = () => {
      if (['closed'].includes(data.state)) {
        $('.delete-all-container').css('display', 'flex');
      } else {
        $('.delete-all-container').css('display', 'none');
      }
    }

    $('#datatable').on('click', '.delete', function () {
      const id = $(this).attr('data-id')
      const name = $(this).attr('data-name')

      const deleteURL = `/admin/masterdata/event/delete`
      const formData = new FormData()
      formData.append('id', id)
      formData.append('_token', csrfToken)

      swal({
        text: `Ingin menghapus event ${name}?`,
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
                text: `Event ${name} berhasil dihapus`
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

    $('.tab-item').on('click', function (e) {
      e.preventDefault()

      data.state = $(this).attr('data-state')

      toggleDeleteAllButton()
      table.ajax.reload()

      $('.tab-item').each(function (i, obj) {
        if ($(obj).attr('data-state') === data.state) {
          $(obj).addClass('active')
        } else {
          $(obj).removeClass('active')
        }
      });
    });

    $('#delete-all').on('click', function (e) {
        let stateText = null
        if (data.state === 'closed') {
          stateText = 'Sudah Selesai';
        }

        // Verify state
        if (stateText === null) return false;
        
        swal({
          text: `Ingin menghapus semua jadwal event ${stateText}?`,
          icon: 'warning',
          buttons: true,
          dangerMode: true,
        })
        .then((confirm) => {
          if (confirm) {
            const deleteURL = `/admin/masterdata/event/delete-all`;
            const formData = new FormData();
            formData.append('state', data.state);
            formData.append('_token', csrfToken);
            
            fetch(deleteURL, {
              method: 'POST',
              body: formData
            }).then(res => res.json()).then(data => {
              if (data.status) {
                table.ajax.reload();
                swal({
                  title: 'Deleted',
                  icon: 'success',
                  text: `Semua event ${stateText} berhasil dihapus`
                });
              } else {
                console.log(data.message);
                swal(data.message, { icon: 'error' });
              }
            });
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
            url: "/api/event/listDatatable",
            method: 'POST',
            data: function (data) {
              data.state = getData('state');
            }
          },
          columns: [
            {data: 'name', title: 'Nama Event', name: 'name'},
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
            {data: 'start_date', title: 'Tanggal Awal', name: 'start_date'},
            {data: 'end_date', title: 'Tanggal Akhir', name: 'end_date', 
              "render": function ( data, type, row, meta ) {
                return data || '-';
              }
            },
            {data: 'offer', title: 'Share', orderable: false, searchable: false, className: 'd-inline-flex',
              "render": function ( data, type, row, meta ) {
                if (data === null) {
                  return '-';
                } else {
                  const shareURL = `https://www.facebook.com/sharer/sharer.php?u=${row.link}`;

                  let start_date = moment.utc(row.start_date).local();
                  start_date = start_date.format('ddd, D MMMM Y');

                  let end_date = moment.utc(row.end_date).local();
                  end_date = end_date.format('ddd, D MMMM Y');

                  const zone_name = moment.tz.guess();
                  const timezone = moment.tz(zone_name).zoneAbbr();

                  let eventDateText = `Event Date: ${start_date}`;
                  if (row.end_date !== row.start_date) eventDateText += ` - ${end_date}`;

                  const message = `Live Streaming Event - ${row.name}\n\nDescription\n\t${eventDateText}\n\tLink: ${data.short_link}`;

                  const text = encodeURIComponent(message);
                  const shareURLTW = `https://twitter.com/intent/tweet?text=${text}`;

                  return `
                    <button class="share-to-fb btn btn-sm" data-share="${shareURL}">
                      <img src="/images/fb-logo-2.png" alt="Facebook Logo" style="height: 20px; width: 20px">
                    </button>

                    <br />

                    <button class="share-to-twitter btn btn-sm" data-share="${shareURLTW}">
                      <img src="/images/twitter-logo-2.png" alt="Twitter Logo" style="height: 20px; width: 20px">
                    </button>
                  `
                }
              }
            },
            {data: 'id', title: 'Dibuat', name: 'created', orderable: false, searchable: false, className: 'no-wrap',
              "render": function ( data, type, row, meta ) {
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
            {data: 'id', title: 'Diubah', name: 'updated', orderable: false, searchable: false, className: 'no-wrap',
              "render": function ( data, type, row, meta ) {
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
                let updateRoute
                updateRoute = `/admin/masterdata/event/update/${data}`

                return `
                  <a href="${updateRoute}" class="btn btn-sm unrounded btn-primary">
                    <small>Edit Event</small>
                  </a>

                  <button
                    data-id="${data}"
                    data-name="${row.name}"
                    class="btn btn-sm btn-danger unrounded delete"
                  >
                    <small>Hapus Event</small>
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
