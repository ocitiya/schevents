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
          <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <h5 class="text-primary">
          Schedule Detail
        </h5>
      </div>

      <div class="data-center">
        <div class="row">
          <div class="col-7">
            <div class="row mb-3">
              <div class="col-5 text-secondary">
                <label>Sport Type</label>
              </div>
              <div class="col-7">
                <label class="">{{ $data->sport_type->name }}</label> 
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-7">
            <div class="row mb-3">
              <div class="col-5 text-secondary">
                <label>School</label>
              </div>
              <div class="col-7">
                <label class="">{{ $data->school1->name }}</label> 
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-7">
            <div class="row mb-3">
              <div class="col-5 text-secondary">
                <label>VS School</label>
              </div>
              <div class="col-7">
                <label class="">{{ $data->school2->name }}</label> 
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-7">
            <div class="row mb-3">
              <div class="col-5 text-secondary">
                <label>Team Gender</label>
              </div>
              <div class="col-7">
                <label class="capitalize">{{ $data->team_gender }}</label> 
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-7">
            <div class="row mb-3">
              <div class="col-5 text-secondary">
                <label>Stream URL</label>
              </div>
              <div class="col-7">
                <a href="{{ $data->link }}" class="" noopener noreferrer target="_blank">{{ $data->link }}</a> 
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-7">
            <div class="row mb-3">
              <div class="col-5 text-secondary">
                <label>Date</label>
              </div>
              <div class="col-7">
                <label class="" id="date">{{ $data->datetime }}</label> 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const datetime = $('#date').text()

      const date = moment.utc(datetime).local().format('DD MMMM YYYY hh:mm')
      const zone_name =  moment.tz.guess()
      const timezone = moment.tz(zone_name).zoneAbbr()

      $('#date').text(`${date} ${timezone}`)
    })
  </script>
@endsection