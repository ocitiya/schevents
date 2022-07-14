@extends('layouts.admin.master')

@section('content')
  <div id="schools" class="content">
    <div class="title-container">
      <h4 class="text-primary">Sekolah</h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <a href="{{ route('admin.school.create') }}" class="btn btn-primary btn-sm unrounded">
          Tambah Sekolah&nbsp;
          <i class="fa-solid fa-plus"></i>
        </a>

        <div>
          <form action="" autocomplete="off" method="POST">
            <input class="form-control" placeholder="Search" type="text" id="search">
          </form>
        </div>
      </div>

      <div class="data-center">
        <div class="data-list" id="school-items">
          {{-- Dynamic Data --}}
        </div>
      </div>

      <div class="data-footer">
        <nav aria-label="Page navigation example">
          <ul class="pagination d-flex align-items-center justify-content-end">
            <li class="page-item">
              <button
                class="page-link"
                id="previous"
                aria-label="Previous"
              >
                <span aria-hidden="true">&laquo;</span>
              </button>
            </li>
            <li>
              <div class="input-group">
                <input type="text" class="form-control" id="pagination_page">
                <div class="input-group-append">
                  <div class="input-group-text">&nbsp;/&nbsp;
                    <span id="pagination_total_page">
                      {{-- Dynamic Data --}}
                    </span>
                  </div>
                </div>
              </div>
            </li>
            <li class="page-item">
              <button
                id="next"
                class="page-link"
                aria-label="Next"
              >
                <span aria-hidden="true">&raquo;</span>
              </button>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    const deleteURL = "<?php echo route('admin.school.delete') ?>"
    let searchTimeout = null;
    let pageTimeout = null;

    let pagination = {
      limit: 10,
      page: 1,
      search: null,
      total: 0,
      total_page: 0
    }

    const createSchoolItem = (data) => {
      const detailRoute = `/admin/school/detail/${data.id}`
      const updateRoute = `/admin/school/update/${data.id}`

      $('#school-items').append(`
        <div class="card text-center shadow-sm">
          <div class="card-header text-end">
            <button
              data-id="${data.id}"
              data-name="${data.name}"
              class="btn btn-outline-danger btn-sm unrounded delete-item"
            >
              Hapus&nbsp;
              <i class="fa-solid fa-trash"></i>
            </button>
          </div>
          
          <div class="card-body">
            <img src="/storage/school/logo/${data.logo}" style="width: 75px" class="mb-3">
            
            <h5 class="card-title">${data.name}</h5>
            <div class="card-text">
              <small>Tingkat Sekolah</small>
              <div class="capitalize">${data.level_of_education}</div>
            </div>

            <div class="card-text mt-0">
              <small>Kota</small>
              <div class="capitalize">${data.county.name}</div>
            </div>
          </div>
          <div class="card-footer text-muted">
            <a
              href="${detailRoute}"
              class="btn btn-primary btn-sm"
            >
              Lihat&nbsp;
              <i class="fa-solid fa-eye"></i>
            </a>
            
            <a
              href="${updateRoute}"
              class="btn btn-primary btn-sm"
            >
              Ubah&nbsp;
              <i class="fa-solid fa-pen-to-square"></i>
            </a>
          </div>
        </div>
    `)
    }
    
    const getList = async ({ page = pagination.page, limit = pagination.limit, search = pagination.search } = {}) => {
      const data = await new Promise((resolve, reject) => {
        search = search === null ? '' : `&search=${search}`

        let endpoint = '/api/school/list'
        endpoint = `${endpoint}?page=${page}&limit=${limit}`
        endpoint = endpoint+search

        fetch(endpoint).then(res => res.json()).then(data => {
          if (data.status) {
            resolve(data.data)
          } else {
            alert(data.message)
            reject()
          }
        })
      })

      $('#school-items').empty()

      if (data.list.length > 0) {
        data.list.map(item => createSchoolItem(item))
      } else {
        $('#school-items').text('No Data')
      }

      pagination = { ...data.pagination }
      
      $('#pagination_page').val(pagination.page)
      $('#pagination_total_page').text(`${pagination.total_page}`)

      if (pagination.page === 1) {
        $('#previous').addClass('disabled')
      } else {
        $('#previous').removeClass('disabled')
      }

      if (pagination.page >= pagination.total_page) {
        $('#next').addClass('disabled')
      } else {
        $('#next').removeClass('disabled')
      }
    }
    
    document.addEventListener('DOMContentLoaded', async function () {
      getList()
      $('#next').on('click', function() {
        getList({ page: parseInt(page) + 1 })
      })

      $('#previous').on('click', function() {
        getList({ page: parseInt(page) - 1 })
      })

      $('#pagination_page').on('keyup', function() {
        const val = $(this).val()

        searchTimeout = setTimeout(() => {
          getList({ page: val })
        }, 500)
      })

      $('#search').on('keyup', function () {
        const val = $(this).val()

        if (searchTimeout !== null) clearTimeout(searchTimeout)
        searchTimeout = setTimeout(() => {
          getList({ search: val })
        }, 500);
      })

      $('#schools').on('click', '.delete-item', function(e) {
        const id = $(this).attr('data-id')
        const name = $(this).attr('data-name')

        const formData = new FormData()
        formData.append('id', id)
        formData.append('_token', csrfToken)
        
        swal({
          text: `Ingin menghapus ${name}?`,
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
                getList()
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
    })
  </script>
@endsection