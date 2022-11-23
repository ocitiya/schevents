@php
  $title = "{$data->federation->abbreviation} - {$data->school1->name} ({$data->school1->municipality->name}, {$data->school1->county->abbreviation}) vs {$data->school2->name} ({$data->school2->municipality->name}, {$data->school2->county->abbreviation})";
  $team_type = empty($data->team_type) ? null : $data->team_type->name;
  $description = "Watch online {$team_type} {$data->team_gender} {$data->sport_type->name}";
  $team = "{$team_type} {$data->team_gender} {$data->sport_type->name}";
  $school1 = $data->school1->name;
  $school2 = $data->school2->name;
  $stream_url = $data->lpsport->short_link;
  $federation = $data->federation->abbreviation;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <meta name="description" content="{{ $description }}" >
  <meta name="keywords" content="{{ $data->keywords }}">
  <meta name="robots" content="index,follow">

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
    <div class="text-center">
      Powered by
    </div>
    <div class="text-center mt-3">
      <img src="{{ "/storage/federation/logo/{$data->federation->logo}" }}" style="width: 80px">
      <img src="/images/playon.jpg" style="width: 80px">
    </div>

    <div class="c2 mt-5">
      <h5 class="mb-4"><b>
        {{ $team_type }}
        @if (!empty($data->team_gender))
        {{ $data->team_gender }}
        @endif
        {{ $data->sport_type->name }}
      </b></h5>

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
              {{ $data->school1->name }}<br/>
              {{ $data->school1->municipality->name }},
              {{ $data->school1->county->abbreviation }}
            </div>
          </div>

          <div class="d-flex justify-content-center align-items-center">vs</div>

          <div class="text-center">
            <div>
              @if (!empty($data->school2->logo))
                <img src="{{ "/storage/school/logo/{$data->school2->logo}" }}" style="width: 80px">
              @else
                <img src="/images/no-logo-1.png" style="width: 80px">
              @endif
            </div>
            <div>
              {{ $data->school2->name }}<br/>
              {{ $data->school2->municipality->name }},
              {{ $data->school2->county->abbreviation }}
            </div>
          </div>
        </div>

        <div class="mt-5">
          <b>
            <span id="datetime">
              {{ date("d M Y H:i", strtotime($data->datetime)) }}
            </span>
          </b>
        </div>
      </div>

      <div class="mt-5">
        <a class="btn btn-light" id="stream" href="{{ $stream_url }}"><b>
          <i class="fa-solid fa-video"></i>
          &nbsp;Watch Online
        </b></a>
        <a class="btn btn-light" href="/"><b>
          <i class=""></i>
          &nbsp;More Event
        </b></a>
      </div>

      <div class="share-container mt-5">
        <h5><b>Share this event</b></h5>

        <div class="d-flex gap-2 flex-wrap pt-2">
          <button id="share-to-fb" class="btn btn-sm">
            <img src="/images/fb-logo-2.png" alt="Facebook Logo" style="height: 30px; width: 30px">
          </button>

          <button id="share-to-twitter" class="btn btn-sm">
            <img src="/images/twitter-logo-2.png" alt="Twitter Logo" style="height: 30px; width: 30px">
          </button>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('js/moment.min.js') }}"></script>
  <script src="{{ asset('js/moment-timezone-with-data.js') }}"></script>
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/fontawesome-free-6.1.1-web.all.min.js') }}"></script>

  <script>
    const title = "<?php echo $title ?>";
    const description = "<?php echo $description ?>";
    const keywords = "<?php echo $data->keywords ?>";
    const team = "<?php echo $team ?>";
    const school1 = "<?php echo $school1 ?>";
    const school2 = "<?php echo $school2 ?>";
    const stream_url = "<?php echo $stream_url ?>";
    const federation = "<?php echo $federation ?>";

    let hashtag = keywords.split(',');
    hashtag = hashtag.filter((a) => a);
    hashtag.map((item, i) => {
      const a = item.replace(/ /g, '');
      hashtag[i] = `#${a}`
    })

    hashtag = hashtag.join(' ');

    document.addEventListener('DOMContentLoaded', function () {
      const selfURL = window.location.href;
      const datetimeElem = document.querySelector('#datetime')
      
      const datetime = datetimeElem.innerHTML;
      const datelocal = moment.utc(datetime, 'D MMM YYYY hh:mm').local()
      const formatDate = datelocal.format('ddd, D MMMM Y hh:mm');

      const zone_name = moment.tz.guess();
      const timezone = moment.tz(zone_name).zoneAbbr() 

      datetimeElem.innerHTML = `${formatDate} ${timezone}`;

      document.querySelector('meta[name="description"]').setAttribute("content", `${formatDate} ${timezone}, Watch online ${team}, ${title}`);

      // if (datelocal.isSame(new Date(), 'day') || moment().add(3, 'hours').isAfter(datelocal)) {
      //   // null
      // } else {
      //   document.querySelector('#stream').style.display = 'none';
      // }

      document.querySelector('#share-to-fb').addEventListener('click', function(){
        const shareURL = `https://www.facebook.com/sharer/sharer.php?u=${stream_url}`;
        window.open(shareURL, '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');
      });

      document.querySelector('#share-to-twitter').addEventListener('click', function(){
        const desc = this.getAttribute('data-description');
        const text = encodeURIComponent(`${federation}\n${team} | ${formatDate} ${timezone}\n${school1} vs ${school2}\nWatch on\n${selfURL}\nor\n${stream_url}\n\nShare this event to everyone and happy watching the game !`);
        const shareURL = `https://twitter.com/intent/tweet?text=${text}`;
        window.open(shareURL, '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');
      });
    });
  </script>
</body>
</html>