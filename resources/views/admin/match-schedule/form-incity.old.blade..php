@extends('layouts.admin.master')

@section('content')
  <div id="match-schedule" class="content">
    <div class="title-container">
      <h4 class="text-primary">Jadwal Pertandingan</h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item" aria-current="page">
            <a href="{{ route('admin.match-schedule.incity.index') }}">Index</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Form</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <h5 class="text-primary">
          @if(!isset($data))
            <span>Buat Jadwal Pertandingan</span>
          @else
            <span>Edit Jadwal Pertandingan</span>
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
          action="{{ route('admin.match-schedule.store') }}"
          method="POST"
          autocomplete="off"
          class="form-container row"
        >
          {{ csrf_field() }}

          <input type="hidden" name="id" value="{{ isset($data) ? $data->id : null }}">

          <div class="col-7">
            <div class="row">
              <div class="col-5">
                <label for="name">Federasi *</label>
              </div>
              <div class="col-7">
                <select required name="federation_id" class="form-select select2" id="federation_id">
                  <option disabled selected value>Please select ...</option>
                  @foreach ($federations as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="name">Olahraga *</label>
              </div>
              <div class="col-7">
                <select required name="sport_type_id" class="form-select select2" id="sport_type_id">
                  <option disabled selected value>Pilih Federasi Dulu</option>
                  {{-- Dynamic Data --}}
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="name">Sekolah *</label>
              </div>
              <div class="col-7">
                <select required name="school1_id" class="form-select select2" id="school1_id">
                  <option disabled selected value>Pilih Federasi Dulu</option>
                  {{-- Dynamic Data --}}
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="name">Sistem Pertandingan</label>
              </div>
              <div class="col-7">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="match_system" value="home" id="match_system_home">
                  <label class="form-check-label" for="match_system_home">
                    Home
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="match_system" value="away" id="match_system_away">
                  <label class="form-check-label" for="match_system_away">
                    Away
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="match_system" value="neutral" id="match_system_neutral">
                  <label class="form-check-label" for="match_system_neutral">
                    Neutral
                  </label>
                </div>
              </div>
            </div>

            @if (isset($_GET['sudah-bermain']) || isset($_GET['minggu-lalu']))
              <div class="row">
                <div class="col-5">
                  <label for="score1">Skor 1</label>
                </div>
                <div class="col-7">
                  <input type="number" name="score1" class="form-control" >
                </div>
              </div>
            @endif
            
            <div class="row">
              <div class="col-5">
                <label for="name"></label>
              </div>
              <div class="col-7">
                VS
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="name">Sekolah 2 *</label>
              </div>
              <div class="col-7">
                <select required name="school2_id" class="form-select select2" id="school2_id">
                  <option disabled selected value>Pilih Federasi Dulu</option>
                  {{-- Dynamic Data --}}
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="name">Sistem Pertandingan</label>
              </div>
              <div class="col-7">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="match_system2" value="home" id="match_system2_home">
                  <label class="form-check-label" for="match_system2_home">
                    Home
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="match_system2" value="away" id="match_system2_away">
                  <label class="form-check-label" for="match_system2_away">
                    Away
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="match_system2" value="neutral" id="match_system2_neutral">
                  <label class="form-check-label" for="match_system2_neutral">
                    Neutral
                  </label>
                </div>
              </div>
            </div>

            @if (isset($_GET['sudah-bermain']) || isset($_GET['minggu-lalu']))
              <div class="row">
                <div class="col-5">
                  <label for="score2">Skor 2</label>
                </div>
                <div class="col-7">
                  <input type="number" name="score2" class="form-control" >
                </div>
              </div>
            @endif

            @if (isset($_GET['sudah-bermain']) || isset($_GET['minggu-lalu']))
              <div class="row">
                <div class="col-5">
                  <label for="youtube_link">Link Youtube</label>
                </div>
                <div class="col-7">
                  <input type="text" name="youtube_link" class="form-control" >
                </div>
              </div>
            @endif

            <div class="row">
              <div class="col-5">
                <label for="name">Tipe Tim *</label>
              </div>
              <div class="col-7">
                <select required name="team_type_id" class="form-select select2" id="team_type_id">
                  <option disabled selected value>Please select ...</option>
                  @foreach ($team_types as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="name">Stadion</label>
              </div>
              <div class="col-7">
                <input type="text" name="stadium" class="form-control" value="{{ old('stadium', isset($data) ? $data->stadium : null) }}">
              </div>
            </div>
          
            <div class="row">
              <div class="col-5">
                <label for="name">Jenis Tim</label>
              </div>
              <div class="col-7">
                <select name="team_gender" class="form-select select2" id="team_gender">
                  <option disabled selected value>Please select ...</option>
                  <option value="boy">Laki-laki</option>
                  <option value="girl">Perempuan</option>
                </select>
              </div>
            </div>

            <div class="border p-3 my-3">
              <small class="">
                <i class="fa-solid fa-triangle-exclamation"></i>&nbsp;
                Tanggal harus berada di zona waktu UTC (+0000)
              </small>

              <div class="row">
                <div class="col-5">
                  <label for="name">Tanggal Pertandingan *</label>
                </div>
                <div class="col-7">
                  <input required type="date" id="date" name="date" class="form-control" value="{{ old('date', isset($data) ? $data->date : null) }}">
                </div>
              </div>

              <div class="row">
                <div class="col-5">
                  <label for="name">Waktu Pertandingan *</label>
                </div>
                <div class="col-3">
                  <select name="time_hour" id="time_hour" class="form-select select2" required>
                    @for ($i = 0; $i <= 23; $i++)
                      <option value="{{ sprintf('%02d', $i) }}">{{ sprintf('%02d', $i) }}</option>
                    @endfor
                  </select>
                </div>

                <div class="col-3">
                  <select name="time_minute" id="time_minute" class="form-select select2" required>
                    @for ($i = 0; $i <= 59; $i++)
                      <option value="{{ sprintf('%02d', $i) }}">{{ sprintf('%02d', $i) }}</option>
                    @endfor
                  </select>
                </div>
              </div>
            </div>

            <div class="form-button">
              <button type="submit" class="btn btn-primary btn-sm unrounded">
                Buat Jadwal&nbsp;
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
    const sportSelected = "<?php echo old('sport_type_id', isset($data) ? $data->sport_type_id : null) ?>";
    const school1Selected = "<?php echo old('school1_id', isset($data) ? $data->school1_id : null) ?>";
    const school2Selected = "<?php echo old('school2_id', isset($data) ? $data->school2_id : null) ?>";
    const teamTypeSelected = "<?php echo old('team_type_id', isset($data) ? $data->team_type_id : null) ?>";
    const teamGenderSelected = "<?php echo old('team_gender', isset($data) ? $data->team_gender : null) ?>";
    const timeHourSelected = "<?php echo old('time_hour', isset($data) ? $data->time_hour : null) ?>";
    const timeMinuteSelected = "<?php echo old('time_minute', isset($data) ? $data->time_minute : null) ?>";
    const matchSystemSelected = "<?php echo old('match_system', isset($data) ? $data->match_system : null) ?>";
    const matchSystem2Selected = "<?php echo old('match_system2', isset($data) ? $data->match_system2 : null) ?>";

    const getList = (endpoint) => {
      return new Promise((resolve, reject) => {
        fetch(endpoint)
          .then(res => res.json())
          .then(data => {
            if (data.status) {
              resolve(data.data.list)
            } else {
              alert(data.message)
              reject()
            }
          })
      })
    }

    document.addEventListener('DOMContentLoaded', function() {
      $('#federation_id').on('change', async function () {
        const val = $(this).val()

        const schools = await getList(`/api/school/list?showall=true&federation_id=${val}`)
        generateSelect('#school1_id', schools, false)
        $('#school1_id').val(school1Selected).change()

        generateSelect('#school2_id', schools, false)
        $('#school2_id').val(school2Selected).change()

        const sports = await getList(`/api/sport-type/list?showall=true&federation_id=${val}`)
        generateSelect('#sport_type_id', sports, false)
        $('#sport_type_id').val(sportSelected).change()
      })

      $('#team_gender').val(teamGenderSelected).change()
      $('#time_hour').val(timeHourSelected).change()
      $('#time_minute').val(timeMinuteSelected).change()
      $('#team_type_id').val(teamTypeSelected).change()

      if (matchSystemSelected !== null) {
        $(`#match_system_${matchSystemSelected}`).prop("checked", true);
      }

      if (matchSystem2Selected !== null) {
        $(`#match_system_${matchSystem2Selected}`).prop("checked", true);
      }

      const datetime = $('#datetimeHidden').daterangepicker({
        autoUpdateInput: false,
        singleDatePicker: true,
        timePicker: true,
        applyClass: 'form-control',
        timePicker24Hour: true,
        scrollMonth : false,
        scrollInput : false
      });

      $('#datetimeHidden').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD MMMM YYYY - H:mm'));
        $('#datetime').val(picker.startDate.format('YYYY/MM/DD hh:mm:ss'))
      });

      $('#datetimeHidden').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
        $('#datetime').val('');
      });
    })
  </script>
@endsection
