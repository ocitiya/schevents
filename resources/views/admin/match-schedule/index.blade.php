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
        @if (inRole(["user", "admin", "superadmin"]))
          @if ($federation_id != null)
            <a
              href="{{ route('admin.match-schedule.create', ["federation_id" => $federation_id]) }}"
              class="btn btn-primary btn-sm unrounded"
            >
              Tambah Jadwal&nbsp;
              <i class="fa-solid fa-plus"></i>
            </a>
          @else
            <a
              href="{{ route('admin.match-schedule.create') }}"
              class="btn btn-primary btn-sm unrounded"
            >
            Tambah Jadwal&nbsp;
              <i class="fa-solid fa-plus"></i>
            </a>
          @endif
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
          <button class="nav-link tab-item" type="button" role="tab" data-state="tomorrow">
            Besok
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
            @if (inRole(["admin", "superadmin"]))
              <div class="mb-3 justify-content-end delete-all-container" style="display: none">
                <button id="delete-all" class="btn btn-sm unrounded btn-danger text-end" type="button">
                  <i class="fa-solid fa-trash"></i>&nbsp;
                  <small>Hapus Semua</small>
                </button>
              </div>
            @endif

            <div id="schedule-items" style="width: 100%">
              <table id="datatable" class="table table-bordered" style="font-size: small"></table>
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

    const toggleDeleteAllButton = () => {
      if (['have-played', 'last-week', 'old-data'].includes(data.state)) {
        $('.delete-all-container').css('display', 'flex');
      } else {
        $('.delete-all-container').css('display', 'none');
      }
    }

    document.addEventListener('DOMContentLoaded', async function () {
      toggleDeleteAllButton();

      $('#delete-all').on('click', function (e) {
        let stateText = null
        if (data.state === 'have-played') {
          stateText = 'sudah bermain'
        } else if (data.state === 'last-week') {
          stateText = 'minggu lalu'
        } else if (data.state === 'old-data') {
          stateText = 'data lama'
        }

        // Verify state
        if (stateText === null) return false
        
        swal({
          text: `Ingin menghapus semua jadwal pertandingan ${stateText}?`,
          icon: 'warning',
          buttons: true,
          dangerMode: true,
        })
        .then((confirm) => {
          if (confirm) {
            const deleteURL = `/admin/match-schedule/delete-all`
            const formData = new FormData()
            formData.append('state', data.state)
            formData.append('_token', csrfToken)
            
            fetch(deleteURL, {
              method: 'POST',
              body: formData
            }).then(res => res.json()).then(data => {
              if (data.status) {
                table.ajax.reload()
                swal({
                  title: 'Deleted',
                  icon: 'success',
                  text: `Semua jadwal pertandingan ${stateText} berhasil dihapus`
                })
              } else {
                console.log(data.message)
                swal(data.message, { icon: 'error' });
              }
            })
          }
        })
      })

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

      function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
      }

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

      $(function () {
        table = $('#datatable').DataTable({
          dom: '<"dt-top"if><"dt-t"rt><"dt-bottom"lp><"clear">',
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
            {data: 'school1', title: 'Club 1', name: 'school1',
              "render": function ( data, type, row, meta ) {
                if (data !== null) {
                  if (row.school1.county === null) {
                    return data.name;
                  } else {
                    return `<b>${row.school1.county.abbreviation}</b> <br/> ${data.name}`;
                  }
                } else {
                  return 'Unknown School';
                }
              }
            },
            {data: 'school2', title: 'Club 2', name: 'school2',
              "render": function ( data, type, row, meta ) {
                if (data !== null) {
                  if (row.school2.county === null) {
                    return data.name;
                  } else {
                    return `<b>${row.school2.county.abbreviation}</b> <br/> ${data.name}`;
                  }
                } else {
                  return 'Unknown School'
                }
              }
            },
            {data: 'federation', title: 'Federasi', name: 'federation',
              "render": function ( data, type, row, meta ) {
                if (data === null) {
                  return '-';
                } else {
                  return data.abbreviation
                }
              }
            },
            {data: 'sport', title: 'Olahraga', name: 'sport',
              "render": function ( data, type, row, meta ) {
                if (data !== null) {
                  return data.name;
                } else {
                  if (row.sport_type !== null) {
                    if (row.sport_type.sport !== null) {
                      return row.sport_type.sport.name;
                    } else {
                      return row.sport_type.name;
                    }
                  } else {
                    return '-';
                  }
                }
              }
            },
            {data: 'datetime', title: 'Tanggal Main', name: 'datetime',
              className: 'no-wrap',
              "render": function ( data, type, row, meta ) {
                const formatDate1 = moment(data).format('DD-MM-Y')
                const formatTime1 = moment(data).format('hh:mm')
                
                const timezone = moment().tz(moment.tz.guess()).format('z')
                const formatDate2 = moment.utc(data).local().format('DD-MM-Y')
                const formatTime2 = moment.utc(data).local().format('hh:mm')

                return `${formatDate1} <br/> ${formatTime1} UTC <br/><br/> ${formatDate2} <br/> ${formatTime2} ${timezone}`
              }
            },
            {data: 'id', title: 'Share', orderable: false, searchable: false,
              "render": function ( data, type, row, meta ) {
                if (row.lpsport !== null) {
                  const origin = window.location.origin;
                  const shareURL = `https://www.facebook.com/sharer/sharer.php?u=${row.lpsport.short_link}`;

                  let hashtag = row.keywords.split(',');
                  hashtag = hashtag.filter((a) => a);
                  hashtag.map((item, i) => {
                    const a = item.replace(/ /g, '');
                    hashtag[i] = `#${a}`
                  })

                  hashtag = hashtag.join(' ');

                  const datetime = row.datetime
                  
                  // const datelocal = moment.utc(datetime, 'YYYY-MM-DD hh:mm').local()
                  const datelocal = moment.utc(datetime, 'YYYY-MM-DD hh:mm')

                  const formatDate = datelocal.format('ddd, D MMMM Y');
                  const formatTime = datelocal.format('hh:mm');
                  const zone_name = moment.tz.guess();
                  const timezone = moment.tz(zone_name).zoneAbbr()

                  const team_type = row.team_type === null ? null : row.team_type.name
                  const gender = row.team_gender !== null ? `${capitalizeFirstLetter(row.team_gender)} ` : ''
                  
                  let stadium = '';
                  if (row.stadium !== null) {
                    stadium = row.stadium.name;
                  } else {
                    stadium = '-';
                  }
                  
                  let sport = '';
                  if (row.sport !== null) {
                    sport = row.sport.name;
                  } else {
                    if (row.sport_type !== null) {
                      if (row.sport_type.sport !== null) {
                        sport = row.sport_type.sport.name;
                      } else {
                        sport = row.sport_type.name;
                      }
                    }
                  }

                  const federationAbbreviation = row.federation !== null ? row.federation.abbreviation : null;
                  const championship = row.championship !== null ? row.championship.name : null;

                  const t1 = championship === null ? federationAbbreviation : championship;

                  let text = `GAMEDAY\n${team_type} ${gender}${sport} Live Streaming HD\n`;
                  text += `${row.school1.name} vs ${row.school2.name}\n`;
                  text += `Watch Live: ${row.lpsport.short_link} or https://live.schsports.com\n`;
                  text += `Date: ${formatDate}\n`;
                  text += `Time: ${formatTime} UTC\n`;
                  text += `Venue: ${stadium}\n\n`;
                  text += hashtag;
                  
                  // let text = `${team_type} ${gender}${sport} | ${formatDate} ${timezone}\n${row.school1.name}`;
                  // if (t1 !== null) {
                  //   text = `${t1}\n${text}`;
                  // }

                  // if (row.school1.county !== null) {
                  //   text += ` (${row.school1.county.abbreviation})`;
                  // }

                  // text +=  ` vs ${row.school2.name}`;

                  // if (row.school2.county !== null) {
                  //   text += ` (${row.school1.county.abbreviation})`;
                  // }

                  // text += `\nWatch on\n${row.lpsport.short_link}\n${hashtag}`;
                  text = encodeURIComponent(text);

                  const shareURLTW = `https://twitter.com/intent/tweet?text=${text}`;

                  return `
                    <button class="share-to-fb btn btn-sm" data-share="${shareURL}">
                      <img src="/images/fb-logo-2.png" alt="Facebook Logo" style="height: 20px; width: 20px">
                    </button>

                    <br />

                    <button class="share-to-twitter btn btn-sm" data-share="${shareURLTW}">
                      <img src="/images/twitter-logo-2.png" alt="Twitter Logo" style="height: 20px; width: 20px">
                    </button>
                  `;
                } else {
                  return '-';
                }
              }
            },
            {data: 'created_at', title: 'Dibuat', orderable: false, searchable: false,
              className: 'no-wrap',
              "render": function (data, type, row, meta) {
                const date = moment(data).format('DD-MM-Y')
                const time = moment(data).format('hh:mm:ss ZZ')

                const name = row.created_by === null ? '' : row.created_by.name

                return `${date} <br/> ${time} <br/> ${name}`
              }
            },
            {data: 'updated_at', title: 'Diubah', orderable: false, searchable: false,
              className: 'no-wrap',
              "render": function (data, type, row, meta) {
                if (data === null) {
                  return '-'
                } else {
                  const date = moment(data).format('DD-MM-Y')
                  const time = moment(data).format('hh:mm:ss ZZ')
                  const name = row.updated_by === null ? '-' : row.updated_by.name

                  return `${date} <br/> ${time} <br/> ${name}`
                }
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

                const deleteButton = `
                  <button
                    class="btn btn-sm unrounded btn-danger delete"
                    data-id="${d}"
                  >
                    <small>Hapus</small>
                  </button>
                `;

                return `
                  <a href="${updateRoute}" class="btn btn-sm unrounded btn-primary">
                    <small>Edit</small>
                  </a>

                  ${deleteButton}
                `;
              }
            },
          ]
        })
      })
    })
  </script>
@endsection