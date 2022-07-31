<template>
  <div class="q-px-md q-py-xl page bg-grey-1 shadow-1">
    <div class="text-center text-h5 text-primary text-bold">
      Latest Video
    </div>

    <div class="q-my-xl">
      <div v-if="data.length > 0" class="video-container">
        <q-card v-ripple class="event-card" v-for="item in data" :key="item.id">
          <q-card-section class="flex flex-center">
            <iframe v-if="item.youtube_link !== null" height="100" width="178" :src="item.youtube_link" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <q-img v-else :src="`${$host}/images/no-video.jpg`" :ratio="16/9" style="height: 100px; width: 178px"/>
          </q-card-section>

          <q-separator />

          <q-card-section class="q-py-lg text-justify">
            {{ item.school1.name }} ({{ item.school1.county.name }}) vs {{ item.school2.name }} ({{ item.school2.county.name }})
            - {{ item.team_type.name }} at {{ scheduleDate(item.datetime) }}
            - {{ scheduleTime(item.datetime) }}
            - <span v-if="item.stadium !== null">{{ item.stadium }}</span>
            - <span v-if="item.team_gender !== null" class="capitalize">{{ item.team_gender }}</span>&nbsp;{{ item.sport_type.name }}
          </q-card-section>
        </q-card>
      </div>

      <div v-else class="text-primary text-bold flex flex-center">
        No Data Available
      </div>

      <q-pagination v-if="pagination.total_page > 0"
        class="flex flex-center q-mt-xl"
        v-model="pagination.page"
        :max="pagination.total_page"
        @update:model-value="getData"
        input
      />
    </div>
  </div>
</template>

<script>
import Helper from 'src/services/helper'
import 'moment-timezone'
import moment from 'moment'

export default {
  data: function () {
    return {
      data: [],
      loading: true,
      pagination: {
        page: 1,
        total_page: 1
      }
    }
  },

  mounted: function () {
    this.getData()
  },

  methods: {
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
        const page = this.pagination.page

        let endpoint = 'match-schedule/latest-video'
        endpoint = Helper.generateURLParams(endpoint, 'page', page)

        this.$api.get(endpoint).then((response) => {
          const { data, message, status } = response.data

          if (status) {
            this.data = [...data.list]
            this.pagination = {
              ...this.pagination,
              page: data.pagination.page,
              total_page: data.pagination.total_page
            }
            resolve()
          } else {
            reject()
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
  .event-card {
    width: 100% !important;
  }
}

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
  min-height: 75vh;
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
