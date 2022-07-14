<template>
  <q-page>
    <div class="bg-primary text-white page-title flex flex-center">
      <div class="text-h4">
        schsports.com
      </div>

      <div class="text-subtitle1 q-mt-lg">
        Find American School Sports Match Schedule
      </div>
    </div>

    <svg id="visual" class="bg-grey-2 title-waves" viewBox="0 0 900 200" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"><path d="M0 62L10.7 60.5C21.3 59 42.7 56 64.2 59C85.7 62 107.3 71 128.8 75.5C150.3 80 171.7 80 193 73.5C214.3 67 235.7 54 257 52.7C278.3 51.3 299.7 61.7 321.2 68.5C342.7 75.3 364.3 78.7 385.8 75.3C407.3 72 428.7 62 450 56.5C471.3 51 492.7 50 514.2 50.7C535.7 51.3 557.3 53.7 578.8 55.7C600.3 57.7 621.7 59.3 643 62.5C664.3 65.7 685.7 70.3 707 68.3C728.3 66.3 749.7 57.7 771.2 54.2C792.7 50.7 814.3 52.3 835.8 56C857.3 59.7 878.7 65.3 889.3 68.2L900 71L900 0L889.3 0C878.7 0 857.3 0 835.8 0C814.3 0 792.7 0 771.2 0C749.7 0 728.3 0 707 0C685.7 0 664.3 0 643 0C621.7 0 600.3 0 578.8 0C557.3 0 535.7 0 514.2 0C492.7 0 471.3 0 450 0C428.7 0 407.3 0 385.8 0C364.3 0 342.7 0 321.2 0C299.7 0 278.3 0 257 0C235.7 0 214.3 0 193 0C171.7 0 150.3 0 128.8 0C107.3 0 85.7 0 64.2 0C42.7 0 21.3 0 10.7 0L0 0Z" fill="#ec7505" stroke-linecap="round" stroke-linejoin="miter"></path></svg>

    <div class="q-pa-md page bg-grey-2">
      <q-pull-to-refresh @refresh="refresh">
        <div class="text-primary text-bold text-h4">
          Upcoming Match
        </div>

        <div v-if="schedules.length > 0" class="row q-col-gutter-lg q-mt-md">
          <div v-for="item in schedules" :key="item.id" class="col-12 col-sm-6">
            <q-card v-ripple class="event-card">
              <q-card-section class="flex justify-between items-center">
                <span class="text-h6 text-primary">{{ item.sport_type.name }}</span>

                <div class="flex items-center text-primary">
                  <q-icon name="pin_drop" />&nbsp;
                  {{ `${item.stadium.county.abbreviation}, ${item.stadium.name}` }}
                </div>
                
              </q-card-section>
              <q-separator />

              <q-card-section class="q-py-lg">
                <div class="vs-section">
                  <div class="flex flex-center">
                    <q-img class="logo"
                      :src="`${$host}/storage/school/logo/${item.school1.logo}`"
                      :ratio="1"
                    />

                    <div class="text-bold text-primary q-mt-md">
                      {{ item.school1.name }}
                    </div>
                  </div>

                  <div class="text-body1 text-grey-7 flex flex-center">
                    VS
                  </div>

                  <div class="flex flex-center">
                    <q-img class="logo"
                      :src="`${$host}/storage/school/logo/${item.school2.logo}`"
                      :ratio="1"
                    />

                    <div class="text-bold text-primary q-mt-md">
                      {{ item.school2.name }}
                    </div>
                  </div>
                </div>
              </q-card-section>

              <q-separator />

              <q-card-section class="flex items-center justify-between q-px-md bg-primary text-white">
                <div class="flex flex-center">
                  <q-icon name="calendar_month" />
                  <span class="q-ml-sm">{{ scheduleDate(item.datetime) }}</span>
                </div>

                <div class="flex flex-center">
                  <q-icon name="schedule" />
                  <span class="q-ml-sm">{{ scheduleTime(item.datetime) }}</span>
                </div>
              </q-card-section>
            </q-card>
          </div>
        </div>

        <div v-else class="text-primary text-h6 text-bold flex flex-center q-mt-lg">
          No Upcoming Events
        </div>
      </q-pull-to-refresh>
    </div>
  </q-page>
</template>

<script>
import { defineComponent } from 'vue'
import 'moment-timezone'
import moment from 'moment'

export default defineComponent({
  name: 'IndexPage',
  data: function () {
    return {
      schedules: [],
    }
  },

  mounted: function () {
    this.getSchedule()
  },

  methods: {
    async refresh (done) {
      await this.getSchedule()
      done()
    },

    scheduleDate: function (date) {
      const formatDate = moment.utc(date).local().format('D MMMM Y')
      return formatDate
    },

    scheduleTime: function (date) {
      const formatTime = moment.utc(date).local().format('hh:mm')

      const zone_name =  moment.tz.guess();
      const timezone = moment.tz(zone_name).zoneAbbr() 

      return `${formatTime} ${timezone}`
    },

    getSchedule: function () {
      return new Promise((resolve, reject) => {
        this.$api.get('match-schedule/list').then((response) => {
          const { data, message, status } = response.data

          if (status) {
            this.schedules = data.list
            resolve()
          } else {
            reject()
          }
        })
      })
    }
  }
})
</script>

<style scoped>
  @media only screen and (max-width: 599px) {
    .page {
      padding-left: 20px !important;
      padding-right: 20px !important; 
    }
  }

  @media only screen and (min-width: 600px) and (max-width: 1023px) {
    .page {
      padding-left: 40px !important;
      padding-right: 40px !important; 
    }
  }

  @media only screen and (min-width: 1023px) {
    .page-title {
      min-height: 200px !important;
    }
  }

  .title-waves {
    margin-top: -10px;
  }

  .page {
    margin-top: -20px;
    padding-left: 70px;
    padding-right: 70px; 
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
    border-radius: 20px;
  }

  .vs-section {
    grid-template-columns: 7fr 1fr 7fr;
    grid-auto-flow: column;
    display: grid;
  }
</style>
