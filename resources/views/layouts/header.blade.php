@php    
  use App\Models\App;

  $app = App::first();
@endphp

<div id="header" class="text-dark d-flex justify-content-between align-items-center px-3 fixed-top bg-white">
  <div class="lead title">{{ $app->name }}</div>

  <div class="menu-group">
    <button class="active">Home</button>
  </div>
</div>