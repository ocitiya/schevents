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
      height: 100vh;
      overflow: auto
    }

    .content a {
      color: white;
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

    .card-score .section.team-logo .top-right {
      position: absolute;
      right: 3%;
      width: 8%;
      top: 5%;
      display: flex;
      justify-content: center;
      margin: 0 auto;
    }

    .card-score .section.team-logo .top-left {
      position: absolute;
      left: 3%;
      top: 3%;
      display: flex;
      justify-content: center;
      margin: 0 auto;
      color: white;
      font-size: 0.8em;
      font-weight: 600;
    }

    .card-score .section.team-logo .left {
      position: absolute;
      left: 0;
      width: 50%;
      top: 0;
      bottom: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      padding-right: 13%;
    }

    .card-score .section.team-logo .right {
      position: absolute;
      right: 0;
      width: 50%;
      top: 0;
      bottom: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      padding-left: 13%;
    }

    .card-score .section.team-logo .top {
      position: absolute;
      right: 0;
      left: 0;
      top: 15%;
      display: flex;
      justify-content: center;
      margin: 0 auto;
      color: white;
      font-size: 0.7em;
      font-weight: 600;
    }

    .card-score .section.team-logo .bottom {
      position: absolute;
      right: 0;
      left: 0;
      bottom: 13%;
      display: flex;
      justify-content: center;
      margin: 0 auto;
      color: white;
      font-weight: 600;
      font-size: 0.7em;
    }

    .card-score .section.team-logo .bottom-left {
      position: absolute;
      left: 3%;
      bottom: 3%;
      display: flex;
      justify-content: center;
      margin: 0 auto;
      color: white;
      font-size: 0.4em;
      font-weight: 600;
    }

    .card-score .section.team-logo .center {
      position: absolute;
      right: 0;
      left: 50%;
      top: 50%;
      bottom: 0;
      transform: translate(-50%, -50%);
      display: flex;
      align-items: center;
      justify-content: center;
      width: 10%;
    }

    .card-score .section.footer {
      background: #0099fa;
      color: white;
      padding: 10px;
    }

    .nav-link {
      color: white;
    }

    .nav-link:hover {
      color: white;
    }

    .center {
      position: absolute;
      right: 0;
      left: 0;
      top: 50%;
      bottom: 0;
      transform: translateY(-50%);
      text-align: center;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .text-vs {
      /* -webkit-text-stroke-width: 1px;
      -webkit-text-stroke-color: black; */
      font-size: 1.5em;
      font-weight: 700;
    }
  </style>
</head>
<body>
  <div class="content">
    <div class="c2">
      <b>
        <span id="datetime">
          {{ date("d M Y H:i", strtotime($data->datetime)) }}
        </span>
      </b>
      
      <div class="card-score">
        {{-- <div class="left">
          <div class="full-width text-center">
            <div>
              <q-img class="logo"
                :src="`${$host}/storage/school/logo/${item.school1.logo}`"
                :ratio="1"
                width="40%"
              >
                <template v-slot:error>
                  <img :src="`${$host}/images/no-logo-1.png`" style="width: 100%; height: 100%;">
                </template>
              </q-img>
            </div>

            <div class="text-bold text-white text q-mt-xs text-center">
              {{ item.school1.name }}
            </div>
          </div>
        </div>

        <div class="right">
          <div class="full-width text-center">
            <div>
              <q-img class="logo"
                :src="`${$host}/storage/school/logo/${item.school2.logo}`"
                :ratio="1"
                width="40%"
              >
                <template v-slot:error>
                  <img :src="`${$host}/images/no-logo-1.png`" style="width: 100%; height: 100%;">
                </template>
              </q-img>
            </div>

            <div class="text-bold text-white text q-mt-xs text-center">
              {{ item.school2.name }}
            </div>
          </div>
        </div>

        <div class="center" v-if="logo !== null">
          <q-img class="logo"
            :src="`${$host}/storage/app/image/${logo}`"
            :ratio="1"
          >
            <template v-slot:error>
              <img :src="`${$host}/images/no-logo-1.png`" style="width: 100%; height: 100%;">
            </template>
          </q-img>
        </div> --}}

        


        

        

        

        <div class="section team-logo" style="background-image: url('{{ $data->link_stream->image_link }}')">
          <div class="top-right">
            <div>
              <img src="{{ asset("storage/championship/image/{$data->championship->image}") }}" width="100%">
            </div>
          </div>

          <div class="top-left">
            @if (!empty($data->team_type))
              {{ $data->team_type->name }}
            @endif
            &nbsp;
            <span class="capitalize">
              {{ $data->team_gender }}
            </span>&nbsp;
            <span>
              {{ $data->sport->name }}
            </span>
          </div>

          <div class="left">
            <div>
              <div class="text-center">
                <img src="{{ asset("storage/school/logo/{$data->school1->logo}") }}" width="40%">
              </div>
              <div class="text-center mt-2">
                <b>{{ $data->school1->name }}</b>
              </div>
            </div>
          </div>

          <div class="right">
            <div>
              <div class="text-center">
                <img src="{{ asset("storage/school/logo/{$data->school2->logo}") }}" width="40%">
              </div>
              <div class="text-center mt-2">
                <b>{{ $data->school2->name }}</b>
              </div>
            </div>
          </div>

          <div class="center">
            <img src="{{ asset("storage/app/image/{$app->logo}") }}" width="100%">
          </div>

          <div class="top">
            <span class="date"></span>
          </div>

          <div class="bottom">
            <span class="time"></span>
          </div>

          <div class="bottom-left">
            WWW.SCHSPORTS.COM
          </div>
        </div>
        
        <div class="section footer">
          Watch: {{ $data->school1->name }} vs {{ $data->school2->name }} - 
          <span class="time"></span> - 
          <span class="date"></span> - 
          {{ @$data->sport->name }} <span class="text-capitalize">{{ @$data->team_gender }}</span>
        </div>
      </div>

      <div class="mt-5">
        <a class="btn btn-primary" id="stream" href="{{ $stream_url }}"><b>
          <i class="fa-solid fa-video"></i>
          &nbsp;Watch Gane
        </b></a>
        <a class="btn btn-primary" href="/"><b>
          <i class=""></i>
          &nbsp;More Game
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
            <div class="mt-2">
              {{ $data->description }}
            </div>
          </div>
          <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
            <p class="mt-2" style="text-align: justify">
              Watch schsports games or events live and on your laptop or desktop. Check out all the schsports. 
              To watch videos, click <a href="{{ $stream_url }}"><b>Watch Game</b></a> button to watch. 
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
    const title = "<?php echo $title ?>";
    const description = "<?php echo $description ?>";
    const keywords = "<?php echo $data->keywords ?>";
    const team = "<?php echo $team ?>";
    const school1 = "<?php echo $school1 ?>";
    const school2 = "<?php echo $school2 ?>";
    const stream_url = "<?php echo $stream_url ?>";
    let championship = '<?php echo json_encode($championship) ?>';
    championship = JSON.parse(championship);

    let hashtag = keywords.split(',');
    hashtag = hashtag.filter((a) => a);
    hashtag.map((item, i) => {
      const a = item.replace(/ /g, '');
      hashtag[i] = `#${a}`
    })

    hashtag = hashtag.join(' ');

    let time = null;
    let date = 

    document.addEventListener('DOMContentLoaded', function () {
      const selfURL = window.location.href;
      const datetimeElem = document.querySelector('#datetime')
      
      const datetime = datetimeElem.innerHTML;
      const datelocal = moment.utc(datetime, 'D MMM YYYY hh:mm').local()
      const formatDate = datelocal.format('ddd, D MMMM Y | hh:mm');
      
      const zone_name = moment.tz.guess();
      const timezone = moment.tz(zone_name).zoneAbbr();

      date = datelocal.format('D MMM YYYY');
      time = datelocal.format('hh:mm') + ' ' + timezone;
      const eld = document.querySelectorAll('.date');
      const elt = document.querySelectorAll('.time');

      eld.forEach(item => item.innerHTML = date);
      elt.forEach(item => item.innerHTML = time);

      datetimeElem.innerHTML = `${formatDate} ${timezone}`;

      document.querySelector('meta[name="description"]').setAttribute("content", `${formatDate} ${timezone}, Watch online ${team}, ${title}`);

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
        const text = encodeURIComponent(`${championship.abbreviation}\n${team} | ${formatDate} ${timezone}\n${school1} vs ${school2}\nWatch on\nhttps://live.schsports.com\nor\n${stream_url}\n\nShare this event to everyone and happy watching the game !`);
        const shareURL = `https://twitter.com/intent/tweet?text=${text}`;
        window.open(shareURL, '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');
      });
    });
  </script>
</body>
</html>