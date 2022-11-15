<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <meta name="description" content="{{ $data->movie->description }}" >
  <meta name="keywords" content="{{ $data->movie->types }}">
  <meta name="robots" content="index,follow">

  <title>{{ $data->movie->name }}</title>
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

  <style>
    body {
      background-image: linear-gradient(to right bottom, #29415d, #194f7c, #1473b9, #0099fa);
    }

    .content {
      padding: 80px 30px;
      color: white;
      height: 100vh;
      width: 640px;
      margin: auto;
      max-width: 100%;
    }

    .c2 {
      width: 500px;
      max-width: 100%;
      margin: auto;
    }

    .card-score {
      margin-top: 100px;
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
      <div>{{ $data->movie->filmmaker }}</div>
      <h5>{{ $data->movie->name }}</h5>
      <div>Live Streaming</div>
    </div>

    <div class="card-score">
      <div class="row2">
        <div class="text-center">
          <div>
            {{ $data->movie->filmmaker }}<br/>
            <b>{{ $data->movie->name }}</b><br/>
            On Show
          </div>
        </div>

        <div class="text-center">
          <div>
            @if (!empty($data->movie->image))
              <img src="{{ "/storage/movie/image/{$data->movie->image}" }}" style="width: 80px">
            @else
              <img src="/images/no-logo-1.png" style="width: 80px">
            @endif
          </div>
        </div>
      </div>

      <div class="mt-5">
        {{-- <b>
          <span id="datetime">
            {{ date("d M Y H:i", strtotime($data->datetime)) }}
          </span>
        </b> --}}

        <a class="btn btn-light" id="stream" href="#"><b>
          <i class="fa-solid fa-video"></i>
          &nbsp;Stream Now
        </b></a>
      </div>
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

  <script src="{{ asset('js/moment.min.js') }}"></script>
  <script src="{{ asset('js/moment-timezone-with-data.js') }}"></script>
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/fontawesome-free-6.1.1-web.all.min.js') }}"></script>

  <script>
    const title = "<?php echo $data->movie->name ?>";
    const description = "<?php echo $data->movie->description ?>";
    const release_date = "<?php echo $data->show_date ?>";
    const genre = "<?php echo $data->movie->types ?>";
    const link = "<?php echo $data->link ?>";

    document.addEventListener('DOMContentLoaded', function () {
      const selfURL = window.location.href;
      const show_date = moment(release_date).format('ddd, D MMM YYYY')
      // const datetimeElem = document.querySelector('#datetime')
      
      // const datetime = datetimeElem.innerHTML;
      // const datelocal = moment.utc(datetime, 'D MMM YYYY hh:mm').local()
      // const formatDate = datelocal.format('ddd, D MMMM Y hh:mm');

      // const zone_name = moment.tz.guess();
      // const timezone = moment.tz(zone_name).zoneAbbr() 

      // datetimeElem.innerHTML = `${formatDate} ${timezone}`;

      // document.querySelector('meta[name="description"]').setAttribute("content", `${formatDate} ${timezone}, Watch online ${team}, ${title}`);

      // if (datelocal.isSame(new Date(), 'day') || moment().add(3, 'hours').isAfter(datelocal)) {
      //   // null
      // } else {
      //   document.querySelector('#stream').style.display = 'none';
      // }

      document.querySelector('#share-to-fb').addEventListener('click', function(){
        const shareURL = `https://www.facebook.com/sharer/sharer.php?u=${selfURL}`;
        window.open(shareURL, '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');
      });

      document.querySelector('#share-to-twitter').addEventListener('click', function(){
        const desc = this.getAttribute('data-description');
        const text = encodeURIComponent(`Live Streaming Movie - ${title}\n\nDescription\n\tRelease Date: ${show_date}\n\tGenre: ${genre}\n\tLink: ${link}\n\tSinopsis: ${description || '-'}`);
        const shareURL = `https://twitter.com/intent/tweet?text=${text}`;
        window.open(shareURL, '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');
      });
    });
  </script>
</body>
</html>