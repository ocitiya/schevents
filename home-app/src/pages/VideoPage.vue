<template>
  <div class="q-px-md q-py-xl bg-accent">
    <div class="text-center text-h5 text-primary text-bold q-mb-xl">
      Videos
    </div>

    <div class="q-my-xl">
      <div v-if="videos.length > 0">
        <div class="flex q-gutter-md">
          <q-card v-for="item in videos" :key="item.id" class="bg-white q-pa-md card" bordered  @click="() => toDetail(item.id)">
            <q-card-section class="q-py-lg schedule-team-logo"
              :style="{
                backgroundImage: 'linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url(\'' + $host + '/storage/link_stream/image/' + item.link_stream.image + '\')',
                color: 'white',
                textShadow: '-1px 0 black, 0 1px black, 1px 0 black, 0 -1px black'
              }"
            >
              <div class="left">
                <div class="full-width text-center">
                  <div>
                    <q-img class="logo"
                      :src="`${$host}/storage/school/logo/${item.school1.logo}`"
                      :ratio="1"
                      width="40%"
                    >
                      <template v-slot:error>
                        <img :src="`${$host}/images/no-logo-1.png`" style="width: 100%; height: 100%;">
                      </template>
                    </q-img>
                  </div>
  
                  <div class="text-bold text-white text q-mt-xs text-center text-caption" style="line-height: 1;">
                    {{ item.school1.name }}
                  </div>
                </div>
              </div>
  
              <div class="right">
                <div class="full-width text-center">
                  <div>
                    <q-img class="logo"
                      :src="`${$host}/storage/school/logo/${item.school2.logo}`"
                      :ratio="1"
                      width="40%"
                    >
                      <template v-slot:error>
                        <img :src="`${$host}/images/no-logo-1.png`" style="width: 100%; height: 100%;">
                      </template>
                    </q-img>
                  </div>
  
                  <div class="text-bold text-white text q-mt-xs text-center text-caption" style="line-height: 1;">
                    {{ item.school2.name }}
                  </div>
                </div>
              </div>
  
              <div class="center" v-if="logo !== null">
                <q-img class="logo"
                  :src="`${$host}/storage/app/image/${logo}`"
                  :ratio="1"
                >
                  <template v-slot:error>
                    <img :src="`${$host}/images/no-logo-1.png`" style="width: 100%; height: 100%;">
                  </template>
                </q-img>
              </div>
  
              <div class="top-left">
                <span v-if="item.team_type !== null">
                  {{ item.team_type.name }}
                </span>&nbsp;
                <span class="capitalize">
                  {{ item.team_gender }}
                </span>&nbsp;
                <span>
                  {{ item.sport.name }}
                </span>
              </div>
  
              <div class="top-right" v-if="item.championship !== null">
                <q-img class="logo"
                  :src="`${$host}/storage/championship/image/${item.championship.image}`"
                  :ratio="1"
                >
                  <template v-slot:error>
                    <img :src="`${$host}/images/no-logo-1.png`" style="width: 100%; height: 100%;">
                  </template>
                </q-img>
              </div>
  
              <div class="top" style="top: 30%;">
                {{ scheduleDate(item.datetime) }}
              </div>
  
              <div class="bottom" style="bottom: 30%;">
                {{ scheduleTime(item.datetime) }}
              </div>
  
              <div class="bottom text-caption" style="bottom: 2%; font-size: 0.6em; letter-spacing: 2px;">
                WWW.SCHSPORTS.COM
              </div>
            </q-card-section>
  
            <q-separator />
  
            <q-card-section class="text-justify q-px-md">
              <div class="flex items-center justify-between">
                <div>
                  <small>
                    <q-icon name="calendar_month" />
                    {{ scheduleDate(item.datetime) }}
                  </small>
                </div>
  
                <div>
                  <small>
                    <q-icon name="schedule" />
                    {{ scheduleTime(item.datetime) }}
                  </small>
                </div>
              </div>
              <div class="text-body1 q-mt-sm">
                Watch: {{ item.school1.name }} vs {{ item.school2.name }} 
              </div>
  
              <hr />
  
              <div class="text-description" v-html="item.description" />
            </q-card-section>
          </q-card>
        </div>

        <div class="flex items-center justify-center" v-if="pagination.page < pagination.total_page">
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
      logo: null,
      videos: [],
      loading: true,
      pagination: {
        page: 1,
        total_page: 1
      }
    }
  },

  mounted: function () {
    this.getAppData()
    this.getData()

    useMeta({
      title: 'Video',
    })
  },

  methods: {
    nextPage: function () {
      this.pagination.page++;
      this.getData();
    },

    toDetail: function (id) {
      setTimeout(() => {
        // this.$router.push({ name: 'news.detail', params: { id } })
        window.open(`${this.$host}/video-schedule/${id}`)
      }, 300)
    },
    
    getAppData () {
      this.$api.get('app/detail').then((response) => {
        const { data, message, status } = response.data

        // this.title = data.name
        this.logo = data.logo
      })
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
            const prev = [...this.videos]
            this.videos = [...prev, ...data.list]

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

<style scoped lang="scss">
@media only screen and (max-width: 599px) {
  .page {
    padding-left: 20px !important;
    padding-right: 20px !important;
  }

  .card {
    max-width: 100% !important;
  }
}

.card {
  max-width: 300px;
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

.schedule-team-logo {
  aspect-ratio: 16/9;
  background-size: cover;
  position: relative;

  .top-right {
    position: absolute;
    right: 3%;
    width: 8%;
    top: 5%;
    display: flex;
    justify-content: center;
    margin: 0 auto;
  }

  .top-left {
    position: absolute;
    left: 5%;
    top: 8%;
    display: flex;
    justify-content: center;
    margin: 0 auto;
    color: white;
    font-size: 0.9em;
    font-weight: 600;
  }

  .left {
    position: absolute;
    left: 0;
    width: 50%;
    top: 0;
    bottom: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    padding-right: 13%;
  }

  .right {
    position: absolute;
    right: 0;
    width: 50%;
    top: 0;
    bottom: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    padding-left: 13%;
  }

  .top {
    position: absolute;
    right: 0;
    left: 0;
    top: 15%;
    display: flex;
    justify-content: center;
    margin: 0 auto;
    color: white;
    font-size: 0.7em;
    font-weight: 600;
  }

  .bottom {
    position: absolute;
    right: 0;
    left: 0;
    bottom: 13%;
    display: flex;
    justify-content: center;
    margin: 0 auto;
    color: white;
    font-weight: 600;
    font-size: 0.7em;
  }

  .bottom-left {
    position: absolute;
    left: 3%;
    bottom: 3%;
    display: flex;
    justify-content: center;
    margin: 0 auto;
    color: white;
    font-size: 0.4em;
    font-weight: 600;
  }

  .center {
    position: absolute;
    right: 0;
    left: 50%;
    top: 50%;
    bottom: 0;
    transform: translate(-50%, -50%);
    display: flex;
    align-items: center;
    justify-content: center;
    width: 10%;
  }

  .text-vs {
    /* -webkit-text-stroke-width: 1px;
    -webkit-text-stroke-color: black; */
    font-size: 1.5em;
    font-weight: 700;
  }
}

.text-description {
  overflow: hidden;
  text-overflow: ellipsis;
  display: -webkit-box;
  -webkit-line-clamp: 3; /* number of lines to show */
          line-clamp: 3; 
  -webkit-box-orient: vertical;
}
</style>
