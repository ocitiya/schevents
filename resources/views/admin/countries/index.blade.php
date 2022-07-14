@extends('layouts.admin.master')

@section('content')
  <div id="countries" class="content">
    <div class="title-container">
      <h4 class="text-primary">Negara</h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <a id="create_button" href="{{ route('admin.location.countries.create') }}" class="btn btn-primary btn-sm unrounded">
          Tambah Negara&nbsp;
          <i class="fa-solid fa-plus"></i>
        </a>

        <div>
          <form action="" autocomplete="off" method="POST">
            <input class="form-control" placeholder="Search" type="text" id="search">
          </form>
        </div>
      </div>

      <div class="data-center">
        <div class="data-list" id="country-items">
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
    let searchTimeout = null;
    let pageTimeout = null;

    let pagination = {
      limit: 10,
      page: 1,
      search: null,
      total: 0,
      total_page: 0
    }

    const createCountryItem = (data) => {
      const detailRoute = `/admin/location/countries/detail/${data.id}`
      const updateRoute = `/admin/location/countries/update/${data.id}`

      $('#country-items').append(`
        <div class="card text-center shadow-sm">
          <div class="card-body">
            <h5 class="card-title">${data.name}</h5>
            <div class="card-text">
              <small>Kode Negara</small>
              <div>${data.alpha2_code}</div>
            </div>

            <div class="card-text mt-0">
              <small>Kode Telepon</small>
              <div>${data.dial_code}</div>
            </div>
          </div>
          <div class="card-footer text-muted">
            <a
              href="${detailRoute}"
              class="btn btn-primary btn-sm"
            >
              View&nbsp;
              <i class="fa-solid fa-eye"></i>
            </a>
            
            <a
              href="${updateRoute}"
              class="btn btn-primary btn-sm"
            >
              Edit&nbsp;
              <i class="fa-solid fa-pen-to-square"></i>
            </a>
          </div>
        </div>
    `)
    }
    
    const getList = async ({ page = pagination.page, limit = pagination.limit, search = pagination.search } = {}) => {
      const data = await new Promise((resolve, reject) => {
        search = search === null ? '' : `&search=${search}`

        let endpoint = '/api/country/list'
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

      $('#country-items').empty()

      if (data.list.length > 0) {
        data.list.map(item => createCountryItem(item))
        $('#create_button').addClass('disabled')
      } else {
        $('#country-items').text('No Data')
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
          console.log('asd')
        }, 500)
      })

      $('#search').on('keyup', function () {
        const val = $(this).val()

        if (searchTimeout !== null) clearTimeout(searchTimeout)
        searchTimeout = setTimeout(() => {
          getList({ search: val })
        }, 500);
      })
    })
  </script>
@endsection