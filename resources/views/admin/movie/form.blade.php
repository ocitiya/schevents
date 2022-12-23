@extends('layouts.admin.master')

@section('content')
  <div id="movie" class="content">
    <div class="title-container">
      <h4 class="text-primary">Film</h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item" aria-current="page">
            <a href="{{ route('admin.movie.index') }}">Index</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Form</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <h5 class="text-primary">
          @if(!isset($data))
            <span>Tambah Film</span>
          @else
            <span>Ubah Film {{ $data->name }}</span>
          @endisset
        </h5>
      </div>

      <div class="data-center">
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form
          action="{{ route('admin.movie.store') }}"
          method="POST"
          autocomplete="off"
          enctype="multipart/form-data"
          class="form-container row"
        >
          {{ csrf_field() }}

          <input type="hidden" name="id" value="{{ isset($data) ? $data->id : null }}">

          <div class="col-8">
            <div class="row">
              <div class="col-5">
                <label for="name">Nama Film *</label>
              </div>
              <div class="col-7">
                <input type="text" id="name" name="name" class="form-control capitalize" required
                  value="{{ old('name', isset($data) ? $data->name : null) }}"
                >
                <div class="invalid-feedback">
                  Film sudah terdaftar
                </div>
                <div class="valid-feedback">
                  Film bisa didaftarkan
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="name">Jenis Film *</label>
              </div>
              <div class="col-7">
                <select name="movie_type_id[]" class="form-select select2" id="movie_type_id" multiple required>
                  @foreach ($movieTypes as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="release_date">Tanggal Rilis *</label>
              </div>
              <div class="col-7">
                <input required type="date" name="release_date" id="release_date" class="form-control" value="{{ old('release_date', isset($data) ? $data->release_date : null) }}">
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="director">Sutradara</label>
              </div>
              <div class="col-7">
                <input type="text" name="director" id="director" class="form-control" value="{{ old('director', isset($data) ? $data->director : null) }}">
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="produced_by">Diproduksi Oleh</label>
              </div>
              <div class="col-7">
                <input type="text" name="produced_by" id="produced_by" class="form-control" value="{{ old('produced_by', isset($data) ? $data->produced_by : null) }}">
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="cast">Pemeran</label>
              </div>
              <div class="col-7">
                <input type="text" name="cast" id="cast" class="form-control" value="{{ old('cast', isset($data) ? $data->cast : null) }}">
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="filmmaker">Pembuat Film</label>
              </div>
              <div class="col-7">
                <input type="text" name="filmmaker" id="filmmaker" class="form-control" value="{{ old('filmmaker', isset($data) ? $data->filmmaker : null) }}">
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="music_director">Penata Musik</label>
              </div>
              <div class="col-7">
                <input type="text" name="music_director" id="music_director" class="form-control" value="{{ old('music_director', isset($data) ? $data->music_director : null) }}">
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="link">Deskripsi</label>
              </div>
              <div class="col-7">
                <textarea name="description" id="description" class="form-control">{{ old('description', isset($data) ? $data->description : null) }}</textarea>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="duration">Durasi</label>
              </div>
              <div class="col-7">
                <input type="text" name="duration" id="duration" class="form-control" value="{{ old('duration', isset($data) ? $data->duration : null) }}">
              </div>
            </div>

            @if (isset($data))
              <div class="row">
                <div class="col-5"></div>
                <div class="col-7">
                  @if (empty($data->image))
                    <img src="/images/no-logo-1.png" style="width: 100%">
                  @else
                    <img src="{{"/storage/movie/image/{$data->image}" }}" style="width: 100%">
                  @endif
                </div>
              </div>
            @endif

            <div class="row">
              <div class="col-5">
                <label for="image">Gambar</label>
              </div>
              <div class="col-7">
                <input type="file" name="image" id="image" class="form-control" accept=".png, .jpg">
                <div class="">
                  @if (isset($data))
                    <small>Masukkan gambar untuk mengganti gambar | File type: .jpg, .png</small><br><br>
                  @else
                    <small>File type: .jpg, .png</small><br><br>
                  @endif
                </div>
              </div>
            </div>

            <div class="form-button">
              <button id="submit" type="submit" class="btn btn-primary btn-sm unrounded disabled">
                Kirim&nbsp;
                <i class="fa-solid fa-paper-plane"></i>
              </button>
            </div>
          </div>
        </form>
        
        <small class="text-red">*) Harus diisi</small>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    let is_create = "<?php echo !isset($data) ? 1 : 0 ?>"
    is_create = !!parseInt(is_create)

    let movieTypeSelected = `<?php echo old('movie_type_id', isset($data) ? $data->movie_type_id : null) ?>`;
    if (movieTypeSelected !== null && movieTypeSelected !== '') {
      movieTypeSelected = JSON.parse(movieTypeSelected)
    }

    document.addEventListener('DOMContentLoaded', async function () {
      if (!is_create) $('#submit').removeClass('disabled')
      $('#movie_type_id').val(movieTypeSelected).change()

      let validationTimeout
      $('#name').on('keyup', function () {
        const val = $(this).val()

        if (validationTimeout) clearTimeout(validationTimeout)
        validationTimeout = setTimeout(() => {
          const formData = new FormData()
          formData.append('name', val)

          fetch(`/api/movie/validate`, {
            method: 'POST',
            body: formData
          })
            .then((response) => response.json())
            .then((data) => {
              if (data.data) {
                $(this).addClass('is-valid')
                $(this).removeClass('is-invalid')

                $('#submit').removeClass('disabled')
              } else {
                $(this).addClass('is-invalid') 
                $(this).removeClass('is-valid')
              
                $('#submit').addClass('disabled')
              }
            })
        }, 1000);
      });

      tinymce.init({
        menubar: false,
        selector: '#description',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo bold italic underline align | strikethrough | blocks fontfamily fontsize | link image media table | lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
      });
    });
  </script>
@endsection