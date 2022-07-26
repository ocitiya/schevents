<template>
  <div class="q-px-md q-py-xl page">
    <div class="text-center text-h5 text-primary text-bold">
      Club Menu
    </div>

    <div class="flex flex-center q-my-xl">
      <div class="search-container">
        <q-input v-model="search" label="Search School" filled>
          <template v-slot:append>
            <q-icon name="search" />
          </template>
        </q-input>
      </div>
    </div>

    <div class="text-h6 text-primary text-bold text-center q-my-xl">
      Live Events
    </div>

    <div class="event-club-container">
      <q-card v-ripple class="event-card">
        <q-card-section class="text-white bg-primary">
          Boy Tim Inti Sepak Bola
        </q-card-section>

        <q-separator />

        <q-card-section class="q-py-lg">
          <div class="vs-section q-mb-md">
            <div class="text-center q-mr-md">
              Logo

              <div class="text-bold text-primary q-mt-md">
                Alabama School (AL)
              </div>
            </div>
            <div class="text-body1 text-grey-7 flex flex-center">
              VS
            </div>

            <div class="text-center q-ml-md">
              Logo

              <div class="text-bold text-primary q-mt-md">
                Texas School (tx)
              </div>
            </div>
          </div>

          <q-separator />

          <div class="flex items-center text-primary q-mt-md">
            <q-icon name="pin_drop" />&nbsp;
            Stadion Pakansari
          </div>
        </q-card-section>

        <q-separator />

        <q-card-section class="flex items-center justify-between q-px-md bg-primary text-white">
          <div class="flex flex-center">
            <q-icon name="calendar_month" />
            <span class="q-ml-sm">20 Aug 2022</span>
          </div>

          <div class="flex flex-center">
            <q-icon name="schedule" />
            <span class="q-ml-sm">10:00 WIB</span>
          </div>
        </q-card-section>
      </q-card>

      <q-card v-ripple class="event-card">
        <q-card-section class="text-white bg-primary">
          Boy Tim Inti Sepak Bola
        </q-card-section>

        <q-separator />

        <q-card-section class="q-py-lg">
          <div class="vs-section q-mb-md">
            <div class="text-center q-mr-md">
              Logo

              <div class="text-bold text-primary q-mt-md">
                Alabama School (AL)
              </div>
            </div>
            <div class="text-body1 text-grey-7 flex flex-center">
              VS
            </div>

            <div class="text-center q-ml-md">
              Logo

              <div class="text-bold text-primary q-mt-md">
                Texas School (tx)
              </div>
            </div>
          </div>

          <q-separator />

          <div class="flex items-center text-primary q-mt-md">
            <q-icon name="pin_drop" />&nbsp;
            Stadion Pakansari
          </div>
        </q-card-section>

        <q-separator />

        <q-card-section class="flex items-center justify-between q-px-md bg-primary text-white">
          <div class="flex flex-center">
            <q-icon name="calendar_month" />
            <span class="q-ml-sm">20 Aug 2022</span>
          </div>

          <div class="flex flex-center">
            <q-icon name="schedule" />
            <span class="q-ml-sm">10:00 WIB</span>
          </div>
        </q-card-section>
      </q-card>

      <q-card v-ripple class="event-card">
        <q-card-section class="text-white bg-primary">
          Boy Tim Inti Sepak Bola
        </q-card-section>

        <q-separator />

        <q-card-section class="q-py-lg">
          <div class="vs-section q-mb-md">
            <div class="text-center q-mr-md">
              Logo

              <div class="text-bold text-primary q-mt-md">
                Alabama School (AL)
              </div>
            </div>
            <div class="text-body1 text-grey-7 flex flex-center">
              VS
            </div>

            <div class="text-center q-ml-md">
              Logo

              <div class="text-bold text-primary q-mt-md">
                Texas School (tx)
              </div>
            </div>
          </div>

          <q-separator />

          <div class="flex items-center text-primary q-mt-md">
            <q-icon name="pin_drop" />&nbsp;
            Stadion Pakansari
          </div>
        </q-card-section>

        <q-separator />

        <q-card-section class="flex items-center justify-between q-px-md bg-primary text-white">
          <div class="flex flex-center">
            <q-icon name="calendar_month" />
            <span class="q-ml-sm">20 Aug 2022</span>
          </div>

          <div class="flex flex-center">
            <q-icon name="schedule" />
            <span class="q-ml-sm">10:00 WIB</span>
          </div>
        </q-card-section>
      </q-card>

      <q-card v-ripple class="event-card">
        <q-card-section class="text-white bg-primary">
          Boy Tim Inti Sepak Bola
        </q-card-section>

        <q-separator />

        <q-card-section class="q-py-lg">
          <div class="vs-section q-mb-md">
            <div class="text-center q-mr-md">
              Logo

              <div class="text-bold text-primary q-mt-md">
                Alabama School (AL)
              </div>
            </div>
            <div class="text-body1 text-grey-7 flex flex-center">
              VS
            </div>

            <div class="text-center q-ml-md">
              Logo

              <div class="text-bold text-primary q-mt-md">
                Texas School (tx)
              </div>
            </div>
          </div>

          <q-separator />

          <div class="flex items-center text-primary q-mt-md">
            <q-icon name="pin_drop" />&nbsp;
            Stadion Pakansari
          </div>
        </q-card-section>

        <q-separator />

        <q-card-section class="flex items-center justify-between q-px-md bg-primary text-white">
          <div class="flex flex-center">
            <q-icon name="calendar_month" />
            <span class="q-ml-sm">20 Aug 2022</span>
          </div>

          <div class="flex flex-center">
            <q-icon name="schedule" />
            <span class="q-ml-sm">10:00 WIB</span>
          </div>
        </q-card-section>
      </q-card>

    </div>
    

    <div class="list-container">
      <div class="row q-col-gutter-md">
        <div class="col-12 col-md-4">
          <div class="text-primary text-bold text-h5">
            Sport
          </div>

          <q-list separator class="q-mt-md">
            <q-item>tes</q-item>
            <q-item>tes</q-item>
            <q-item>tes</q-item>
            <q-item>tes</q-item>
            <q-item>tes</q-item>
          </q-list>
        </div>

        <div class="col-12 col-md-4">
          <div class="text-primary text-bold text-h5">
            States
          </div>

          <q-list separator class="q-mt-md">
            <q-item>tes</q-item>
            <q-item>tes</q-item>
            <q-item>tes</q-item>
            <q-item>tes</q-item>
            <q-item>tes</q-item>
          </q-list>
        </div>

        <div class="col-12 col-md-4">
          <div class="text-primary text-bold text-h5">
            Association
          </div>

          <q-list separator class="q-mt-md">
            <q-item>tes</q-item>
            <q-item>tes</q-item>
            <q-item>tes</q-item>
            <q-item>tes</q-item>
            <q-item>tes</q-item>
          </q-list>
        </div>
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
</style>
