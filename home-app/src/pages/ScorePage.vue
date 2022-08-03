<template>
  <div class="q-py-md q-py-xl page bg-grey-1 shadow-1 q-px-xl">
    <div class="text-center text-h5 text-primary text-bold">
      Score Menu
    </div>

    <div class="list-container">
      <div v-if="Object.keys(data.this_week).length > 0" class="q-gutter-md">
        <q-card class="q-pa-md" v-for="[key, group] of Object.entries(data.this_week)" :key="key">
          <div class="flex items-center justify-betweeen">
            <div>Logo Web</div>
            <div class="q-ml-md">
              <div>Noteable HS {{ key }} Games</div>
              <div>This Week</div>
            </div>
          </div>

          <q-separator class="q-my-lg" />

          <div class="card-score" v-for="item in group" :key="item.id">
            <q-img v-if="item.school1.logo !== null" class="logo"
              :src="`${$host}/storage/school/logo/${item.school1.logo}`"
              :ratio="1"
            >
              <template v-slot:error>
                <img :src="`${$host}/images/no-logo-1.png`" style="width: 100%; height: 100%;">
              </template>
            </q-img>

            <q-img v-else class="logo"
              :src="`${$host}/images/no-logo-1.png`"
              :ratio="1"
            />

            <div>
              <div class="school">
                <div>
                  <div>{{ item.school1.name }} ({{ item.school1.county.name }})</div>
                  <div>{{ item.score1 || '-' }}</div>
                </div>
                <div>vs</div>
                <div>
                  <div>{{ item.school2.name }} ({{ item.school1.county.name }})</div>
                  <div>{{ item.score2 || '-' }}</div>
                </div>
              </div>

              <div>
                {{ scheduleDate(item.datetime) }} | {{ scheduleTime(item.datetime) }}
                <span v-if="item.stadium !== null">&nbsp;| {{ item.stadium }}</span>
                <span v-if="item.team_gender !== null" class="capitalize">&nbsp;| {{ item.team_gender }}</span>
              </div>

              <div class="flex flex-center q-mt-lg">
                <iframe v-if="item.youtube_link !== null" height="100" width="178" :src="item.youtube_link" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <q-img v-else :src="`${$host}/images/no-video.jpg`" :ratio="16/9" style="height: 100px; width: 178px"/>
              </div>
            </div>

            <q-img v-if="item.school2.logo !== null" class="logo"
              :src="`${$host}/storage/school/logo/${item.school2.logo}`"
              :ratio="1"
            >
              <template v-slot:error>
                <img :src="`${$host}/images/no-logo-1.png`" style="width: 100%; height: 100%;">
              </template>
            </q-img>

            <q-img v-else class="logo"
              :src="`${$host}/images/no-logo-1.png`"
              :ratio="1"
            />
          </div>
        </q-card>
      </div>

      <div v-else class="text-primary text-bold">
        No Noteable This Week Data Available
      </div>
    </div>

    <div class="list-container">
      <div v-if="Object.keys(data.today).length > 0" class="q-gutter-md">
        <q-card class="q-pa-md" v-for="[key, group] of Object.entries(data.today)" :key="key">
          <div class="flex items-center justify-betweeen">
            <div>Logo Web</div>
            <div class="q-ml-md">
              <div>Noteable HS {{ key }} Games</div>
              <div>Today</div>
            </div>
          </div>

          <q-separator class="q-my-lg" />

          <div class="card-score" v-for="item in group" :key="item.id">
            <q-img v-if="item.school1.logo !== null" class="logo"
              :src="`${$host}/storage/school/logo/${item.school1.logo}`"
              :ratio="1"
            >
              <template v-slot:error>
                <img :src="`${$host}/images/no-logo-1.png`" style="width: 100%; height: 100%;">
              </template>
            </q-img>

            <q-img v-else class="logo"
              :src="`${$host}/images/no-logo-1.png`"
              :ratio="1"
            />

            <div>
              <div class="school">
                <div>
                  <div>{{ item.school1.name }} ({{ item.school1.county.name }})</div>
                  <div>{{ item.score1 || '-' }}</div>
                </div>
                <div>vs</div>
                <div>
                  <div>{{ item.school2.name }} ({{ item.school1.county.name }})</div>
                  <div>{{ item.score2 || '-' }}</div>
                </div>
              </div>

              <div>
                {{ scheduleDate(item.datetime) }} | {{ scheduleTime(item.datetime) }}
                <span v-if="item.stadium !== null">&nbsp;| {{ item.stadium }}</span>
                <span v-if="item.team_gender !== null" class="capitalize">&nbsp;| {{ item.team_gender }}</span>
              </div>

              <div class="flex flex-center q-mt-lg">
                <iframe v-if="item.youtube_link !== null" height="100" width="178" :src="item.youtube_link" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <q-img v-else :src="`${$host}/images/no-video.jpg`" :ratio="16/9" style="height: 100px; width: 178px"/>
              </div>
            </div>

            <q-img v-if="item.school2.logo !== null" class="logo"
              :src="`${$host}/storage/school/logo/${item.school2.logo}`"
              :ratio="1"
            >
              <template v-slot:error>
                <img :src="`${$host}/images/no-logo-1.png`" style="width: 100%; height: 100%;">
              </template>
            </q-img>

            <q-img v-else class="logo"
              :src="`${$host}/images/no-logo-1.png`"
              :ratio="1"
            />
          </div>
        </q-card>
      </div>

      <div v-else class="text-primary text-bold">
        No Noteable Today Data Available
      </div>
    </div>
  </div>
</template>

<script>
import 'moment-timezone'
import moment from 'moment'
import Helper from 'src/services/helper'

export default {
  data: function () {
    return {
      data: {
        this_week: [],
        today: []
      },
      loading: true,
      id: this.$route.params.id
    }
  },

  mounted: function () {
    this.getData('hari-ini')
    this.getData('minggu-ini')
  },

  methods: {
    back: function () {
      setTimeout(() => {
        this.$router.push({ name: 'news' })
      }, 500)
    },

    scheduleDate: function (date) {
      const formatDate = moment.utc(date).local().format('dd, D MMMM Y')
      return formatDate
    },

    scheduleTime: function (date) {
      const formatTime = moment.utc(date).local().format('hh:mm')

      const zone_name =  moment.tz.guess();
      const timezone = moment.tz(zone_name).zoneAbbr() 

      return `${formatTime} ${timezone}`
    },

    getData: function (type = 'minggu-ini') {
      this.loading = true
      return new Promise((resolve, reject) => {
        let endpoint = `match-schedule/scores`
        endpoint = Helper.generateURLParams(endpoint, 'type', type)

        this.$api.get(endpoint).then((response) => {
          const { data, message, status } = response.data

          if (status) {
            if (type === 'hari-ini') {
              this.data.today = {...data.list}
            } else {
              this.data.this_week = {...data.list}
            }
            resolve()
          }
        }).finally(() => {
          this.loading = false
        })
      })
    }
  }
}
</script>

<style scoped>
@media only screen and (max-width: 599px) {
  .page {
    padding-left: 20px !important;
    padding-right: 20px !important;
  }
}

.page {
  max-width: 100%;
  width: 720px;
  min-height: 75vh;
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

.logo {
  text-align: center;
  max-height: 75px;
  max-width: 75px;
}
</style>
