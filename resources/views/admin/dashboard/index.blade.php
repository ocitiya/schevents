@extends('layouts.admin.master')

@section('content')
@if (session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
@endif

<div id="dashboard">
  <div class="d-flex align-items-center justify-content-center flex-wrap gap-4">
    @foreach ($federations as $item)
      <div class="card card-info">
        <div class="card-header">
          Total Tim
        </div>
        <div class="card-body">
          <h5 class="card-title">{{ $item->abbreviation }}</h5>
          {{ $item->schools_count }}
          </h5>
        </div>
      </div>
    @endforeach
  </div>
@endsection