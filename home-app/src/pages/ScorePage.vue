<template>
  <div class="q-px-md q-py-xl page">
    <div class="text-center text-h5 text-primary text-bold">
      Score Menu
    </div>

    <div class="list-container">
      <div class="q-gutter-md">
        <q-card class="q-pa-md">
          <div class="flex items-center justify-betweeen">
            <div>Logo Web</div>
            <div>
              <div>Noteable HS Football Games</div>
              <div>This Week</div>
            </div>
          </div>

          <q-separator />

          <div class="card-score">
            <div>
              Logo
            </div>
            <div>
              <div class="school">
                <div>
                  <div>Sekolah A (AL)</div>
                  <div>score</div>
                </div>
                <div>vs</div>
                <div>
                  <div>Sekolah B (Tx)</div>
                  <div>score</div>
                </div>
              </div>

              <div>
                Fri, 20 Aug 2022 | 10:30 WIB | Stadion | Girl
              </div>

              <div class="flex flex-center">
                <iframe height="100" width="178" src="https://www.youtube.com/embed/UaA9W9VvtvE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              </div>
            </div>
            <div>Logo</div>
          </div>

          <q-separator />

          <div class="card-score">
            <div>
              Logo
            </div>
            <div>
              <div class="school">
                <div>
                  <div>Sekolah A (AL)</div>
                  <div>score</div>
                </div>
                <div>vs</div>
                <div>
                  <div>Sekolah B (Tx)</div>
                  <div>score</div>
                </div>
              </div>

              <div>
                Fri, 20 Aug 2022 | 10:30 WIB | Stadion | Boy
              </div>

              <div class="flex flex-center">
                <iframe height="100" width="178" src="https://www.youtube.com/embed/UaA9W9VvtvE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              </div>
            </div>
            <div>Logo</div>
          </div>
        </q-card>

        <q-card class="q-pa-md">
          <div class="flex items-center justify-betweeen">
            <div>Logo Web</div>
            <div>
              <div>Noteable HS Basketball Games</div>
              <div>This Week</div>
            </div>
          </div>

          <q-separator />

          <div class="card-score">
            <div>
              Logo
            </div>
            <div>
              <div class="school">
                <div>
                  <div>Sekolah A (AL)</div>
                  <div>score</div>
                </div>
                <div>vs</div>
                <div>
                  <div>Sekolah B (Tx)</div>
                  <div>score</div>
                </div>
              </div>

              <div>
                Fri, 20 Aug 2022 | 10:30 WIB | Stadion | Girl
              </div>

              <div class="flex flex-center">
                <iframe height="100" width="178" src="https://www.youtube.com/embed/UaA9W9VvtvE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              </div>
            </div>
            <div>Logo</div>
          </div>

          <q-separator />

          <div class="card-score">
            <div>
              Logo
            </div>
            <div>
              <div class="school">
                <div>
                  <div>Sekolah A (AL)</div>
                  <div>score</div>
                </div>
                <div>vs</div>
                <div>
                  <div>Sekolah B (Tx)</div>
                  <div>score</div>
                </div>
              </div>

              <div>
                Fri, 20 Aug 2022 | 10:30 WIB | Stadion | Boy
              </div>

              <div class="flex flex-center">
                <q-img :src="`${$host}/images/no-video.jpg`" :ratio="16/9" height="100px" width="178px"/>
              </div>
            </div>
            <div>Logo</div>
          </div>
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

.page {
  max-width: 100%;
  width: 720px;
  margin: auto;
}

.list-container {
  margin-top: 100px;
}

.card-score {
  display: grid;
  grid-template-columns: 2fr 10fr 2fr;
}

.card-score .school {
  display: grid;
  grid-template-columns: 5fr 1fr 5fr;
}
</style>
