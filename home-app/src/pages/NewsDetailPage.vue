<template>
  <div class="q-px-md q-py-xl page">
    <div v-if="Object.keys(data).length > 0">
      <div class="text-center text-h5 text-primary text-bold">
        {{ data.school1.name }} ({{ data.school1.county.name }}) vs {{ data.school2.name }} 2 ({{ data.school2.county.name }})
      </div>

      <div class="list-container">
        <div class="">
          <q-card class="q-pa-md" flat>
            <div class="text-bold text-primary text-h6">
              <div v-if="data.sport_type !== null">HS {{ data.sport_type.name }} Games</div>
              <div v-else>Unknown Sport</div>
            </div>

            <div class="card-score q-mt-xl">
              <q-img v-if="data.school1.logo !== null" class="logo"
                :src="`${$host}/storage/school/logo/${data.school1.logo}`"
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
                  <div class="text-body1 text-primary">
                    <div>{{ data.school1.name }} ({{ data.school1.county.name }})</div>
                    <div class="text-bold">{{ data.school1.score || '-' }}</div>
                  </div>
                  <div>vs</div>
                  <div class="text-body1 text-primary">
                    <div>{{ data.school2.name }} ({{ data.school2.county.name }})</div>
                    <div class="text-bold">{{ data.school2.score || '-' }}</div>
                  </div>
                </div>

                <div class="text-subtitle2">
                  {{ scheduleDate(data.datetime) }} | {{ scheduleTime(data.datetime) }}
                  <span v-if="data.stadium !== null">&nbsp;| {{ data.stadium }}</span>
                  <span v-if="data.team_gender !== null" class="capitalize">&nbsp;| {{ data.team_gender }}</span>
                </div>

                <div class="flex flex-center q-mt-lg">
                  <iframe v-if="data.youtube_link !== null" height="100" width="178" :src="data.youtube_link" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                  <q-img v-else :src="`${$host}/images/no-video.jpg`" :ratio="16/9" style="height: 100px; width: 178px"/>
                </div>
              </div>
              
              <q-img v-if="data.school2.logo !== null" class="logo"
                :src="`${$host}/storage/school/logo/${data.school2.logo}`"
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

          <q-btn unelevated color="primary" label="Back to News" icon="arrow_back" class="q-mt-md" @click="back" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import 'moment-timezone'
import moment from 'moment'

export default {
  data: function () {
    return {
      data: {},
      loading: true,
      id: this.$route.params.id
    }
  },

  mounted: function () {
    this.getData()
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

    getData: function () {
      this.loading = true
      return new Promise((resolve, reject) => {
        let endpoint = `match-schedule/detail/${this.id}`
        this.$api.get(endpoint).then((response) => {
          const { data, message, status } = response.data

          if (status) {
            this.data = {...data}
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

.logo {
  text-align: center;
  max-height: 75px;
  max-width: 75px;
}
</style>
