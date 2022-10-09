@extends('layouts.admin.master')

@section('content')
  <div id="user" class="content">
    <div class="title-container">
      <h4 class="text-primary">
        App Follow Us
      </h4>
    </div>

    <div class="data-container" style="border: unset">
      <div class="data-header">
        <a href="{{ route('admin.app.follow_us.update') }}" class="btn btn-primary btn-sm unrounded">
          Edit&nbsp;
          <i class="fa-solid fa-pencil"></i>
        </a>
      </div>

      <div class="data-center">
        @if (isset($data))
          <div class="text-center mb-4">
            @if (empty($data->logo))
              <img src="/images/no-logo-1.png" style="max-width: 100%; width: 250px;">
            @else
              <img src="{{ "/storage/app_follow_us/image/{$data->logo}" }}" style="max-width: 100%; width: 250px;">
            @endif
          </div>
        @endif
        
        <div class="row mb-4 mt-5">
          <div class="col-6">
            <div class="h6">Nama</div>
            <div>{{ $data->name }}</div>
          </div>

          <div class="col-6">
            <div class="h6">Link</div>
            <div>{{ $data->link ?? '-' }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection