@extends('layouts.admin.master')

@section('content')
  <div id="user" class="content">
    <div class="title-container">
      <h4 class="text-primary">
        Akun Saya
      </h4>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
      </nav>
    </div>

    <div class="data-container">
      <div class="data-header">
        <a href="{{ route('admin.my-account.edit') }}" class="btn btn-primary btn-sm unrounded">
          Edit&nbsp;
          <i class="fa-solid fa-pencil"></i>
        </a>
      </div>

      <div class="data-center">
        @if (isset($data))
          <div class="text-center mb-4">
            @if (empty($data->user_detail->avatar))
              <img src="/images/no-logo-1.png" style="max-width: 100%; width: 250px;">
            @else
              <img src="{{"/storage/user/image/{$data->user_detail->avatar}" }}" style="max-width: 100%; width: 250px;">
            @endif
          </div>
        @endif
        
        <div class="row mb-4">
          <div class="col-6">
            <div class="h6">Nama</div>
            <div>{{ $data->name }}</div>
          </div>

          <div class="col-6">
            <div class="h6">username</div>
            <div>{{ $data->username }}</div>
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-6">
            <div class="h6">e-mail</div>
            <div>{{ $data->email }}</div>
          </div>

          <div class="col-6">
            <div class="h6">Role</div>
            <div>{{ $data->user_detail->level }}</div>
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-6">
            <div class="h6">No. HP</div>
            <div>{{ $data->user_detail->telephone ?? '-' }}</div>
          </div>

          <div class="col-6">
            <div class="h6">Jenis Kelamin</div>
            <div>{{ $data->user_detail->gender }}</div>
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-12">
            <div class="h6">Alamat</div>
            <div>{{ $data->user_detail->address ?? '-' }}</div>
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-6">
            <div class="h6">Facebook</div>
            <div>{{ $data->user_detail->facebook ?? '-' }}</div>
          </div>

          <div class="col-6">
            <div class="h6">Instagram</div>
            <div>{{ $data->user_detail->instagram ?? '-' }}</div>
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-6">
            <div class="h6">Twitter</div>
            <div>{{ $data->user_detail->twitter ?? '-' }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
