@extends('layouts.admin.master')

@section('content')
  <div id="user" class="content">
    <div class="title-container">
      <h4 class="text-primary">
        User
      </h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
      </nav>
    </div>

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    <div class="data-container">
      <div class="data-header">
        <a href="{{ route('admin.user.create') }}" class="btn btn-primary btn-sm unrounded">
          Tambah User&nbsp;
          <i class="fa-solid fa-plus"></i>
        </a>
      </div>

      <div class="data-center">
        <div id="type-items">
          <table id="datatable" class="table table-bordered" style="font-size: small"></table>
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

      const deleteURL = `/admin/user/delete`
      const formData = new FormData()
      formData.append('id', id)
      formData.append('_token', csrfToken)

      swal({
        text: `Ingin menghapus user ${name}?`,
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
                text: `User ${name} berhasil dihapus`
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
            dom: '<"dt-top"if><"dt-t"rt><"dt-bottom"lp><"clear">',
            processing: true,
            serverSide: true,
            ajax: {
              url: "/api/user/listDatatable"
            },
            columns: [
              {data: 'user', title: 'Nama', name: 'user', 
                "render": function ( data, type, row, meta ) {
                  return data.name
                }
              },
              {data: 'user', title: 'username', name: 'user',
                "render": function ( data, type, row, meta ) {
                  return data.username
                }
              },
              {data: 'level', title: 'Role', name: 'level'},
              {data: 'user', title: 'Status Akun', name: 'active', className: 'no-wrap',
                "render": function ( data, type, row, meta ) {
                  return data.is_active == 1 ? 'Aktif' : 'Tidak Aktif';
                }
              },
              {data: 'id', title: 'Login Terakhir', name: 'last_login', className: 'no-wrap',
                "render": function ( data, type, row, meta ) {
                  const timezone = moment().tz(moment.tz.guess()).format('z')

                  let last_login = row.last_login;
                  if (last_login === null) {
                    last_login = '-';
                  } else {
                    const date = moment.utc(last_login).local().format('D MMM YYYY');
                    const time = moment.utc(last_login).local().format('H:mm:ss');

                    last_login = `${date} <br> ${time} ${timezone}`;
                  }

                  return `
                    ${last_login}
                  `;
                }
              },
              {data: 'id', title: 'Dibuat', name: 'created', className: 'no-wrap',
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
                    ${created_at}<br><br>
                  `;
                }
              },
              {data: 'id', title: 'Diubah', name: 'updated', className: 'no-wrap',
                "render": function ( data, type, row, meta ) {
                  const timezone = moment().tz(moment.tz.guess()).format('z')

                  let updated_at = row.updated_at;
                  if (updated_at === null) {
                    updated_at = '-';
                  } else {
                    const date = moment.utc(updated_at).local().format('D MMM YYYY');
                    const time = moment.utc(updated_at).local().format('HH:mm:ss');

                    updated_at = `${date} <br> ${time} ${timezone}`;
                  }
                  const name = row.updated_name !== null ? row.updated_name.name : '-';

                  return `
                    ${name}<br>
                    ${updated_at}<br><br>
                  `;
                }
              },
              {data: 'id', title: 'Aksi', orderable: false, searchable: false, className: 'no-wrap',
                "render": function ( data, type, row, meta ) {
                  updateRoute = `/admin/user/update/${data}`
                  resetRoute = `/admin/user/reset/${data}`
                  
                  const is_reset = row.user.is_reset

                  let reset = ''
                  if (is_reset == 1) {
                    reset = `
                      <a href="${resetRoute}" class="btn btn-sm unrounded btn-info text-white">
                        <small>Reset Password</small>
                      </a>
                    `;
                  }

                  if (row.level !== 'superadmin') {
                    return `
                    <a href="${updateRoute}" class="btn btn-sm unrounded btn-primary">
                      <small>Edit User</small>
                    </a>

                    ${reset}

                    <button
                      data-id="${data}"
                      data-name="${row.user.name}"
                      class="btn btn-sm btn-danger unrounded delete"
                    >
                      <small>Hapus User</small>
                    </button>
                  `;
                  } else {
                    return '-';
                  }
                }
              }
            ]
        });
      });
    })
  </script>
@endsection