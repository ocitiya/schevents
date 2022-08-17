<template>
  <div class="q-py-md q-py-xl bg-accent q-px-sm q-px-md-xl">
    <div class="text-center text-h5 text-primary text-bold" ref="tab">
      Last Week Scores
    </div>

    <div class="list-container page">
      <div v-if="data.length > 0" class="q-gutter-md">
        <q-card v-for="item in data" :key="item.id" flat class="bg-white q-pa-md" bordered>
          <div class="row">
            <div class="col-7">
              High School
              &nbsp;<span class="capitalize">{{ item.team_gender }}</span>
              &nbsp;{{ item.sport_type.name }}
            </div>

            <div class="col-5 text-center">
              Score
            </div>
          </div>

          <q-separator class="q-mt-md" />

          <div class="row q-mt-md">
            <div class="col-3 flex items-center justify-center">
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
            </div>

            <div class="col-4 flex items-center q-pl-md">
              <div class="text-bold text-primary">
                {{ item.school1.name }} ({{ item.school1.county.abbreviation }})
              </div>
            </div>

            <div class="col-5 flex items-center justify-center">
              <div class="text-primary text-bold text-h4">
                {{ item.score1 || '-'}}
              </div>
            </div>
          </div>

          <div class="row q-mt-md">
            <div class="col-3 flex items-center justify-center">
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

            <div class="col-4 flex items-center q-pl-md">
              <div class="text-bold text-primary">
                {{ item.school2.name }} ({{ item.school2.county.abbreviation }})
              </div>
            </div>

            <div class="col-5 flex items-center justify-center">
              <div class="text-primary text-bold text-h4">
                {{ item.score2 || '-' }}
              </div>
            </div>
          </div>

          <div v-if="item.stadium !== null">
            <q-separator class="q-my-md" />

            <div class="text-center">
              {{ item.stadium }}
            </div>
          </div>

          <q-separator class="q-my-md" />

          <div class="flex items-center justify-between">
            <div>{{ scheduleDate(item.datetime) }}</div>
            <div>{{ scheduleTime(item.datetime) }}</div>
          </div>
        </q-card>

        <div class="flex items-center justify-center q-mt-xl" v-if="pagination.total_page > 1">
          <q-btn class="" label="See More" color="primary" @click="nextPage" />
        </div>
      </div>

      <div v-else class="text-primary text-bold">
        No Data Available
      </div>
    </div>
  </div>
</template>

<script>
import 'moment-timezone'
import moment from 'moment'
import Helper from 'src/services/helper'
import { useMeta } from 'quasar'

export default {
  data: function () {
    return {
      data: [],
      pagination: {
        page: 1,
        total_page: 1
      },
      loading: true,
      id: this.$route.params.id
    }
  },

  mounted: function () {
    this.getData()
    
    useMeta({
      title: 'Score',
    })
  },

  methods: {
    nextPage: async function () {
      this.pagination.page = parseInt(this.pagination.page) + 1 
      await this.getData()
      // Helper.scrollToElement(this.$refs.tab)
    },
    
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

    getData: function (type = 'have-played') {
      Helper.loading(this)

      return new Promise((resolve, reject) => {
        const page = this.pagination.page
        let endpoint = 'match-schedule/list'
        endpoint = Helper.generateURLParams(endpoint, 'page', page)
        endpoint = Helper.generateURLParams(endpoint, 'limit', 10)
        endpoint = Helper.generateURLParams(endpoint, 'type', type)

        this.$api.get(endpoint).then((response) => {
          const { data, message, status } = response.data

          if (status) {
            if (page > 1) {
              this.data = this.data.concat(data.list)
            } else {
              this.data = [...data.list]
            }
            this.pagination = { 
              page: data.pagination.page,
              total_page: data.pagination.total_page
            }

            resolve()
          } else {
            reject()
          }
        }).finally(() => {
          Helper.loading(this, false)
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
