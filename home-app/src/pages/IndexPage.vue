<template>
  <q-page>
    <div class="q-pa-md page">
      <q-pull-to-refresh @refresh="refresh">
        <div class="text-primary text-bold text-h6">
          Upcoming Match
        </div>

        <div v-if="schedules.length > 0" class="row q-col-gutter-lg q-mt-md">
          <div v-for="item in schedules" :key="item.id" class="col-12 col-sm-6">
            <q-card v-ripple>
              <q-card-section class="flex justify-between items-center">
                <span class="text-h6 text-primary">{{ item.sport_type.name }}</span>

                <div class="flex items-center text-primary">
                  <q-icon name="pin_drop" />&nbsp;
                  {{ `${item.stadium.county.abbreviation}, ${item.stadium.name}` }}
                </div>
                
              </q-card-section>
              <q-separator />

              <q-card-section class="q-py-lg">
                <div class="flex items-center justify-around">
                  <div class="flex flex-center">
                    <q-img class="logo"
                      :src="`${$host}/storage/school/logo/${item.school1.logo}`"
                      :ratio="1"
                    />

                    <div class="text-bold text-primary q-mt-md">
                      {{ item.school1.name }}
                    </div>
                  </div>

                  <div class="text-body1 text-grey-7 text-center">
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

  .page {
    padding-top: 75px;
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
</style>
