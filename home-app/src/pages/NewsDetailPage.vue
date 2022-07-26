<template>
  <div class="q-px-md q-py-xl page">
    <div class="text-center text-h5 text-primary text-bold">
      Sekolah 1 (Al) vs Sekolah 2 (Tx)
    </div>

    <div class="list-container">
      <div class="">
        <q-card class="q-pa-md">
          <div class="">
              <div>HS Football Games</div>
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
        </q-card>

        <q-btn unelevated color="primary" label="Back to News" icon="" class="q-mt-md" />
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
