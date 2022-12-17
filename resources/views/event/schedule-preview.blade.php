<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <meta name="description" content="{{ $data->description }}" >
  <meta name="robots" content="index,follow">

  <title>{{ $data->name }}</title>
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

  <style>
    body {
      /* background-image: linear-gradient(to right bottom, #29415d, #194f7c, #1473b9, #0099fa); */
    }

    .content {
      padding: 80px 30px;
      /* color: white; */
      height: 100vh;
      overflow: auto
    }

    .c2 {
      width: 500px;
      max-width: 100%;
      margin: auto;
    }

    .title {
      text-shadow: 2px 3px 0px rgb(120, 120, 120);
    }

    .card-score {
      margin-top: 40px;
      width: 100%;
      border-bottom-right-radius: 20px;
      border-bottom-left-radius: 20px;
    }

    .card-score .section.team-logo {
      aspect-ratio: 16/9;
      background-size: cover;
      position: relative;
    }

    .card-score .section.footer {
      background: #0099fa;
      color: white;
      padding: 10px;
    }
    
  </style>
</head>
<body>
  <div class="content">
    <div class="c2">
      <b>
        <span id="datetime">
          {{ date("d M Y", strtotime($data->start_date)) }}
        </span>
      </b>
      
      <div class="card-score">
        <div class="section team-logo" style="background-image: url('{{ $data->image_link }}')"></div>
        <div class="section footer">
          {{ $data->name }}
          <span id="date"></span>
        </div>
      </div>

      <div class="mt-5">
        <a class="btn btn-primary" id="stream" href="{{ $data->offer->short_link }}"><b>
          <i class="fa-solid fa-video"></i>
          &nbsp;Watch Event
        </b></a>
        <a class="btn btn-primary" href="/"><b>
          <i class=""></i>
          &nbsp;More Event
        </b></a>
      </div>

      <div class="mt-5">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Detail</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">How To Watch</button>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <p class="mt-2">
              {{ $data->description }}
            </p>
          </div>
          <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
            <p class="mt-2" style="text-align: justify">
              Watch schsports games or events live and on your laptop or desktop. Check out all the schsports. 
              To watch videos, click <a href="{{ $data->offer->short_link }}"><b>Watch Game</b></a> button to watch. 
              Don't forget to support your teams!
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('js/moment.min.js') }}"></script>
  <script src="{{ asset('js/moment-timezone-with-data.js') }}"></script>
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/fontawesome-free-6.1.1-web.all.min.js') }}"></script>

  <script>
    const title = "<?php echo $data->name ?>";
    const description = "<?php echo $data->description ?>";

    let time = null;
    let date = null;

    document.addEventListener('DOMContentLoaded', function () {
      const selfURL = window.location.href;
      const datetimeElem = document.querySelector('#datetime')
      
      const datetime = datetimeElem.innerHTML;
      const datelocal = moment.utc(datetime, 'D MMM YYYY').local()
      
      date = datelocal.format('D MMM YYYY');
      document.querySelector('#date').innerHTML = date;

      datetimeElem.innerHTML = `${formatDate} ${timezone}`;

      document.querySelector('#share-to-fb').addEventListener('click', function(){
        const shareURL = `https://www.facebook.com/sharer/sharer.php?u=${selfURL}`;
        window.open(shareURL, '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');
      });

      document.querySelector('#share-to-twitter').addEventListener('click', function(){
        const desc = this.getAttribute('data-description');
        const text = encodeURIComponent(`${championship.abbreviation}\n${team} | ${formatDate} ${timezone}\n${school1} vs ${school2}\nWatch on\nhttps://live.schsports.com\nor\n${stream_url}\n\nShare this event to everyone and happy watching the game !`);
        const shareURL = `https://twitter.com/intent/tweet?text=${text}`;
        window.open(shareURL, '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');
      });
    });
  </script>
</body>
</html>