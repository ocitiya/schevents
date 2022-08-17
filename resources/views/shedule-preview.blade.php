@php
  $title = "{$data->school1->name} ({$data->school1->county->name}) vs {$data->school2->name} ({$data->school2->county->name})"
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $title }}</title>
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

  <style>
    body {
      background-image: linear-gradient(to right bottom, #29415d, #194f7c, #1473b9, #0099fa);
    }

    .content {
      padding: 80px 30px;
      color: white;
      max-height: 100vh;
      overflow: auto
    }

    .c2 {
      width: 500px;
      max-width: 100%;
      margin: auto;
    }

    .card-score .row2 {
      display: grid;
      grid-template-columns: 1fr 1fr;
    }

    .card-score .row3 {
      display: grid;
      grid-template-columns: 10fr 2fr 10fr;
    }

    .title {
      text-shadow: 2px 3px 0px rgb(120, 120, 120);
    }
  </style>
</head>
<body>
  <div class="content">
    <h4 class="text-center mb-5 title"><b>{{ $title }}</b></h4>

    <div class="c2">
      <h5 class="mb-4"><b>{{ $data->sport_type->name }} Games</b></h5>

      <div class="card-score">
        <div class="row3">
          <div class="text-center">
            <div>
              @if (!empty($data->school1->logo))
                <img src="{{ "/storage/school/logo/{$data->school1->logo}" }}" style="width: 80px">
              @else
                <img src="/images/no-logo-1.png" style="width: 80px">
              @endif
            </div>
            <div>
              {{ "{$data->school1->name} ({$data->school1->county->name})" }}
            </div>
            <h4 class="my-4"><b>{{ $data->score1 ?? "-" }}</b></h4>
          </div>

          <div class="text-center">vs</div>

          <div class="text-center">
            <div>
              @if (!empty($data->school2->logo))
                <img src="{{ "/storage/school/logo/{$data->school2->logo}" }}" style="width: 80px">
              @else
                <img src="/images/no-logo-1.png" style="width: 80px">
              @endif
            </div>
            <div>
              {{ "{$data->school2->name} ({$data->school2->county->name})" }}
            </div>
            <h4 class="my-4"><b>{{ $data->score2 ?? "-" }}</b></h45>
          </div>
        </div>

        <div class="">
          <b>
            <span id="datetime">
              {{ date("d M Y H:i", strtotime($data->datetime)) }}
            </span>
          </b>
        </div>
      </div>

      <div class="mt-5">
        <div class="d-flex justify-content-center align-items-center">
          @if (!empty($data->youtube_link))
            <iframe width="100%" height="315" src="{{ $data->youtube_link }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="object-fit: contain;"></iframe>
          @else
            <img src="/images/no-video.jpg" style="width: 100%; max-height: 180px; object-fit: contain;" />                
          @endif
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('js/moment.min.js') }}"></script>
  <script src="{{ asset('js/moment-timezone-with-data.js') }}"></script>
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const datetimeElem = document.querySelector('#datetime')
      
      const datetime = datetimeElem.innerHTML;
      const formatDate = moment.utc(datetime, 'Y MMMM D hh:mm').local().format('ddd, D MMMM Y');
      const formatTime = moment.utc(datetime, 'Y MMMM D hh:mm').local().format('hh:mm');

      const zone_name =  moment.tz.guess();
      const timezone = moment.tz(zone_name).zoneAbbr() 

      datetimeElem.innerHTML = `${formatDate} | ${formatTime} ${timezone}`;
    });
  </script>
</body>
</html>