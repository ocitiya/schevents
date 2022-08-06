<template>
  <div class="q-px-md q-py-xl bg-grey-2">
    <div class="text-center text-h5 text-primary text-bold q-mb-xl">
      Latest Video
    </div>

    <div class="q-my-xl page">
      <div v-if="data.length > 0" class="q-gutter-md">
        <q-card v-for="item in data" :key="item.id" class="bg-white q-pa-md" bordered>
          <q-card-section class="flex flex-center">
            <iframe v-if="item.youtube_link !== null" height="200" width="355" :src="item.youtube_link" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <q-img v-else :src="`${$host}/images/no-video.jpg`" :ratio="16/9" style="height: 200px; width: 355px"/>
          </q-card-section>

          <q-card-section>
            High School
            &nbsp;<span class="capitalize">{{ item.team_gender }}</span>
            &nbsp;{{ item.sport_type.name }}
          </q-card-section>

          <q-separator class="" />

          <q-card-section class="">
            <div class="text-bold text-primary">
              {{ item.school1.name }} ({{ item.school1.county.abbreviation }})
              VS
              {{ item.school2.name }} ({{ item.school2.county.abbreviation }})
            </div>

            <div v-if="item.stadium !== null">
              <q-separator class="q-my-md" />

              <div class="text-center">
                {{ item.stadium }}
              </div>
            </div>
          </q-card-section>

          <q-separator class="" />

          <q-card-section class="flex items-center justify-between">
            <div>{{ scheduleDate(item.datetime) }}</div>
            <div>{{ scheduleTime(item.datetime) }}</div>
          </q-card-section>
        </q-card>

        <div class="flex items-center justify-center" v-if="pagination.total_page > 1">
          <q-btn class="" label="See More" color="primary" @click="nextPage" />
        </div>
      </div>

      <div v-else class="text-primary text-bold flex flex-center">
        No Data Available
      </div>
    </div>
  </div>
</template>

<script>
import Helper from 'src/services/helper'
import 'moment-timezone'
import moment from 'moment'
import { useMeta } from 'quasar'

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

    useMeta({
      title: 'Video',
    })
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
  .page {
    padding-left: 20px !important;
    padding-right: 20px !important;
  }
}

.page {
  max-width: 100%;
  width: 480px;
  min-height: 75vh;
  margin: auto;
}

.video-container {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  gap: 20px;
}
</style>
