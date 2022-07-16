@extends('layouts.admin.master')

@section('content')
  <div id="match-schedule" class="content">
    <div class="title-container">
      <h4 class="text-primary">Match Schedule</h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item" aria-current="page">
            <a href="{{ route('admin.match-schedule.index') }}">Index</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Form</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <h5 class="text-primary">
          @if(!isset($data))
            <span>Create New Schedule</span>
          @else
            <span>Update Schedule</span>
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
                <label for="name">Sport Type *</label>
              </div>
              <div class="col-7">
                <select required name="sport_type_id" class="form-select" id="sport_type_id">
                  <option disabled selected value>Please select ...</option>
                  @foreach ($types as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="name">Kota *</label>
              </div>
              <div class="col-7">
                <select required name="county_id" class="form-select" id="county_id">
                  <option disabled selected value>Please select ...</option>
                  @foreach ($cities as $item)
                    <option value="{{ $item->id }}">{{ $item->name }} - {{ $item->abbreviation }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="name">School *</label>
              </div>
              <div class="col-7">
                <select required name="school1_id" class="form-select" id="school1_id">
                  <option disabled selected value>Please select ...</option>
                  @foreach ($schools as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            
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
                <label for="name">School *</label>
              </div>
              <div class="col-7">
                <select required name="school2_id" class="form-select" id="school2_id">
                  <option disabled selected value>Please select ...</option>
                  @foreach ($schools as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="name">Tipe Tim *</label>
              </div>
              <div class="col-7">
                <select required name="team_type_id" class="form-select" id="team_type_id">
                  <option disabled selected value>Please select ...</option>
                  @foreach ($team_types as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-5">
                <label for="name">Stadium</label>
              </div>
              <div class="col-7">
                <input type="text" name="stadium" class="form-control" value="{{ old('stadium', isset($data) ? $data->stadium : null) }}">
              </div>
            </div>
          
            <div class="row">
              <div class="col-5">
                <label for="name">Team Gender *</label>
              </div>
              <div class="col-7">
                <select required name="team_gender" class="form-select" id="team_gender">
                  <option disabled selected value>Please select ...</option>
                  <option value="boy">Boy</option>
                  <option value="girl">Girl</option>
                </select>
              </div>
            </div>

            <div class="border p-3 my-3">
              <small class="">
                <i class="fa-solid fa-triangle-exclamation"></i>&nbsp;
                This datetime must in UTC Timezone
              </small>

              <div class="row">
                <div class="col-5">
                  <label for="name">Schedule Date *</label>
                </div>
                <div class="col-7">
                  <input required type="date" id="date" name="date" class="form-control" value="{{ old('date', isset($data) ? $data->date : null) }}">
                </div>
              </div>

              <div class="row">
                <div class="col-5">
                  <label for="name">Schedule Time *</label>
                </div>
                <div class="col-3">
                  <select name="time_hour" id="time_hour" class="form-select" required>
                    @for ($i = 0; $i <= 23; $i++)
                      <option value="{{ sprintf('%02d', $i) }}">{{ sprintf('%02d', $i) }}</option>
                    @endfor
                  </select>
                </div>

                <div class="col-3">
                  <select name="time_minute" id="time_minute" class="form-select" required>
                    @for ($i = 0; $i <= 59; $i++)
                      <option value="{{ sprintf('%02d', $i) }}">{{ sprintf('%02d', $i) }}</option>
                    @endfor
                  </select>
                </div>
              </div>
            </div>

            <div class="form-button">
              <button type="submit" class="btn btn-primary btn-sm unrounded">
                Submit&nbsp;
                <i class="fa-solid fa-paper-plane"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    const typeSelected = "<?php echo old('sport_type_id', isset($data) ? $data->sport_type_id : null) ?>";
    const countySelected = "<?php echo old('county_id', isset($data) ? $data->county_id : null) ?>";
    const school1Selected = "<?php echo old('school1_id', isset($data) ? $data->school1_id : null) ?>";
    const school2Selected = "<?php echo old('school2_id', isset($data) ? $data->school2_id : null) ?>";
    const teamTypeSelected = "<?php echo old('team_type_id', isset($data) ? $data->team_type_id : null) ?>";
    const teamGenderSelected = "<?php echo old('team_gender', isset($data) ? $data->team_gender : null) ?>";
    // const datetimeFill = "<?php echo old('datetime', isset($data) ? $data->datetime : null) ?>"
    const timeHourSelected = "<?php echo old('time_hour', isset($data) ? $data->time_hour : null) ?>";
    const timeMinuteSelected = "<?php echo old('time_minute', isset($data) ? $data->time_minute : null) ?>";
    
    document.addEventListener('DOMContentLoaded', function() {
      $('#sport_type_id').val(typeSelected).change()
      $('#county_id').val(countySelected).change()
      $('#school1_id').val(school1Selected).change()
      $('#school2_id').val(school2Selected).change()
      $('#team_gender').val(teamGenderSelected).change()
      $('#time_hour').val(timeHourSelected).change()
      $('#time_minute').val(timeMinuteSelected).change()
      $('#team_type_id').val(teamTypeSelected).change()

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
