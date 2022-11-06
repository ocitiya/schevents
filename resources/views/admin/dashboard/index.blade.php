@extends('layouts.admin.master')

@section('content')
@if (session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
@endif

<div id="dashboard">
  <h3 class="mb-3">Total Tim</h3>

  <div class="d-flex align-items-center  flex-wrap gap-4">
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

  <div class="mt-5">
    @if (inRole(["user"]))
      <h3 class="mb-3">Event Anda</h3>  
    @else
      <h3 class="mb-3">Total Event</h3>  
    @endif

    <div class="d-flex align-items-center flex-wrap gap-4">
      @forelse ($match as $item)
        <div class="card card-info">
          <div class="card-header">
            Total Pertandingan
          </div>
          <div class="card-body">
            <h5 class="card-title">{{ $item->abbreviation }}</h5>
            {{ $item->match_schedule_count }}
            </h5>
          </div>
        </div>
      @empty
        <div class="mb-5">
          @if (inRole(["user"]))
            Anda tidak memiliki jadwal pertandingan!
          @else
            Tidak ada jadwal pertandingan yang tersedia!
          @endif
        </div>
      @endforelse
    </div>
  </div>
@endsection