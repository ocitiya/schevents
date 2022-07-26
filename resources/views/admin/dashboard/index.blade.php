@extends('layouts.admin.master')

@section('content')
<div id="dashboard">
  <div class="d-flex align-items-center justify-content-center flex-wrap gap-4">
    <div class="card card-info">
      <div class="card-header">
        Pertandingan Hari Ini
      </div>
      <div class="card-body">
        <h5 class="card-title">10</h5>
      </div>
    </div>

    <div class="card card-info">
      <div class="card-header">
        Pertandingan Akan Datang
      </div>
      <div class="card-body">
        <h5 class="card-title">300</h5>
      </div>
    </div>

    <div class="card card-info">
      <div class="card-header">
        Pertandingan Sedang Main
      </div>
      <div class="card-body">
        <h5 class="card-title">5</h5>
      </div>
    </div>

    <div class="card card-info">
      <div class="card-header">
        Pertandingan Sudah Main
      </div>
      <div class="card-body">
        <h5 class="card-title">30</h5>
      </div>
    </div>

    <div class="card card-info">
      <div class="card-header">
        Pertandingan Minggu Lalu
      </div>
      <div class="card-body">
        <h5 class="card-title">2</h5>
      </div>
    </div>
  </div>
@endsection