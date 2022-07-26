<template>
  <div class="q-px-md q-py-xl page">
    <div class="text-center text-h5 text-primary text-bold">
      Latest Video
    </div>

    <div class="q-my-xl">
      <div class="video-container">
        <q-card v-ripple class="event-card">
          <q-card-section class="">
            <iframe style="width: 100%" src="https://www.youtube.com/embed/UaA9W9VvtvE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </q-card-section>

          <q-separator />

          <q-card-section class="q-py-lg text-justify">
            Team 1 (Al) vs Team 2 (Tx) - Varsity Team at 5:30 WIB - 07 Jul 2022 - Pakansari Stadium - Boy Football
          </q-card-section>
        </q-card>

        <q-card v-ripple class="event-card">
          <q-card-section class="">
            <q-img :src="`${$host}/images/no-video.jpg`" :ratio="16/9"/>
          </q-card-section>

          <q-separator />

          <q-card-section class="q-py-lg text-justify">
            Team 1 (Al) vs Team 2 (Tx) - Varsity Team at 5:30 WIB - 07 Jul 2022 - Pakansari Stadium - Boy Football
          </q-card-section>
        </q-card>

        <q-card v-ripple class="event-card">
          <q-card-section class="">
            <iframe style="width: 100%" src="https://www.youtube.com/embed/UaA9W9VvtvE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </q-card-section>

          <q-separator />

          <q-card-section class="q-py-lg text-justify">
            Team 1 (Al) vs Team 2 (Tx) - Varsity Team at 5:30 WIB - 07 Jul 2022 - Pakansari Stadium - Boy Football
          </q-card-section>
        </q-card>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      search: null,
      tab: 'live'
    }
  }
}
</script>

<style scoped>
.search-container {
  max-width: 100%;
  width: 400px;
}

.search-container {
  max-width: 100%;
  width: 400px;
}

.page {
  max-width: 100%;
  /* width: 720px; */
  margin: auto;
}

.list-container {
  margin-top: 100px;
}

.title-waves {
    margin-top: -10px;
  }


.schedule-list .q-card__section {
  width: 100%;
}

.logo {
  text-align: center;
  max-height: 75px;
  max-width: 75px;
}

.page-title {
  padding: 50px 20px 20px;
  min-height: 300px;
  flex-direction: column;
}

.event-card {
  width: 300px;
  border-radius: 20px;
}

.vs-section {
  grid-template-columns: 7fr 1fr 7fr;
  grid-auto-flow: column;
  display: grid;
}

.event-club-container {
  display: flex;
  gap: 20px;
  align-items: center;
  justify-content: center;
  flex-wrap: wrap;
}

.video-container {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  gap: 20px;
}
</style>
