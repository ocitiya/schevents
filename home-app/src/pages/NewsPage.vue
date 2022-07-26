<template>
  <div class="q-px-md q-py-xl page">
    <div class="text-center text-h5 text-primary text-bold">
      Latest Post
    </div>

    <div class="list-container">
      <div class="q-gutter-md card">
        <q-card class="q-pa-md news-card" v-ripple @click="$router.push({ name: 'news-detail', query: {id: 1} })">
          <q-section class="">
            <div class="">Football</div>
          </q-section>

          <q-section class="club-container">
            <div>
              <div>Logo</div>
              <div>Sekolah (Al)</div>
            </div>

            <div>Vs</div>
            
            <div>
              <div>Logo</div>
              <div>Sekolah 2 (Tx)</div>
            </div>
          </q-section>
        </q-card>

        <q-card class="q-pa-md news-card" v-ripple @click="() => $routes.push({ name: 'news-detail', query: { id: 1 } })">
          <q-section class="">
            <div class="">Football</div>
          </q-section>

          <q-section class="club-container">
            <div>
              <div>Logo</div>
              <div>Sekolah (Al)</div>
            </div>

            <div>Vs</div>
            
            <div>
              <div>Logo</div>
              <div>Sekolah 2 (Tx)</div>
            </div>
          </q-section>
        </q-card>

        <q-card class="q-pa-md news-card" v-ripple @click="() => $routes.push({ name: 'news-detail', query: { id: 1 } })">
          <q-section class="">
            <div class="">Football</div>
          </q-section>

          <q-section class="club-container">
            <div>
              <div>Logo</div>
              <div>Sekolah (Al)</div>
            </div>

            <div>Vs</div>
            
            <div>
              <div>Logo</div>
              <div>Sekolah 2 (Tx)</div>
            </div>
          </q-section>
        </q-card>

        <q-card class="q-pa-md news-card" v-ripple @click="() => $routes.push({ name: 'news-detail', query: { id: 1 } })">
          <q-section class="">
            <div class="">Football</div>
          </q-section>

          <q-section class="club-container">
            <div>
              <div>Logo</div>
              <div>Sekolah (Al)</div>
            </div>

            <div>Vs</div>
            
            <div>
              <div>Logo</div>
              <div>Sekolah 2 (Tx)</div>
            </div>
          </q-section>
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
  /* width: 720px; */
  margin: auto;
}

.list-container {
  margin-top: 100px;
}

.card {
  margin: auto;
  display: flex;
  align-items: center;
  flex-wrap: wrap;
  justify-content: center;
}

.news-card {
  width: 300px;
}

.news-card .club-container {
  display: grid;
  grid-template-columns: 5fr 1fr 5fr;
}
</style>
