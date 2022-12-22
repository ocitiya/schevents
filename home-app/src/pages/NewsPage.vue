<template>
  <div class="q-py-xl bg-accent">
    <div class="list-container page q-px-xl">
      <div class="q-my-xl">
        <div class="mb-4 flex justify-between items-center">
          <div class="text-h5 text-primary text-bold">New Post</div>
        </div>

        <div v-if="event.recent.length > 0" class="q-mt-md">
          <div class="event-card-container">
            <q-card v-for="item in event.recent" :key="item.id" v-ripple class="event-card" @click="() => toDetail(item.id)">
              <q-card-section class="q-py-lg schedule-team-logo"
                :style="{
                  backgroundImage: 'url(\'' + $host + '/storage/link_stream/image/' + item.link_stream.image + '\')'
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

                    <div class="text-bold text-white text q-mt-xs text-center">
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

                    <div class="text-bold text-white text q-mt-xs text-center">
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

                <div class="top">
                  {{ scheduleDate(item.datetime) }}
                </div>

                <div class="bottom">
                  {{ scheduleTime(item.datetime) }}
                </div>

                <div class="bottom-left">
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

                <div class="text-description">
                  {{ item.description }}
                </div>
              </q-card-section>
            </q-card>
          </div>

          <div v-if="pagination.recent.page < pagination.recent.total_page" class="text-center q-mt-lg">
            <q-btn color="primary" @click="() => next('recent')" label="More" unelevated />
          </div>
        </div>

        <div v-else class="text-center text-body1 text-bold q-mt-md">
          No Data Available
        </div>
      </div>

      <div class="q-my-xl">
        <div class="mb-4 flex justify-between items-center">
          <div class="text-h5 text-primary text-bold">Last Post</div>
        </div>

        <div v-if="event.have_played.length > 0" class="q-mt-md">
          <div class="event-card-container">
            <q-card v-for="item in event.have_played" :key="item.id" v-ripple class="event-card" @click="() => toDetail(item.id)">
              <q-card-section class="q-py-lg schedule-team-logo"
                :style="{
                  backgroundImage: 'url(\'' + $host + '/storage/link_stream/image/' + item.link_stream.image + '\')'
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

                    <div class="text-bold text-white text q-mt-xs text-center">
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

                    <div class="text-bold text-white text q-mt-xs text-center">
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

                <div class="top">
                  {{ scheduleDate(item.datetime) }}
                </div>

                <div class="bottom">
                  {{ scheduleTime(item.datetime) }}
                </div>

                <div class="bottom-left">
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

                <div class="text-description">
                  {{ item.description }}
                </div>
              </q-card-section>
            </q-card>
          </div>

          <div v-if="pagination.have_played.page < pagination.have_played.total_page" class="text-center q-mt-lg">
            <q-btn color="primary" @click="() => next('have-played')" label="More" unelevated />
          </div>
        </div>

        <div v-else class="text-center text-body1 text-bold q-mt-md">
          No Data Available
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import 'moment-timezone'
import moment from 'moment'
import { useMeta } from 'quasar'

import Helper from 'src/services/helper'

export default {
  data: function () {
    return {
      logo: null,
      loading: true,
      event: {
        recent: [],
        have_played: []
      },
      pagination: {
        recent: {
          page: 1,
          total_page: 1
        },
        have_played: {
          page: 1,
          total_page: 1
        }
      }
    }
  },

  mounted: function () {
    this.getEvent('recent')
    this.getEvent('have-played')
    this.getAppData()

    useMeta({
      title: 'News',
    })
  },

  methods: {
    getAppData () {
      this.$api.get('app/detail').then((response) => {
        const { data, message, status } = response.data

        // this.title = data.name
        this.logo = data.logo
      })
    },

    toHome: function (type) {
      setTimeout(() => {
        this.$router.push({ name: 'schedule', query: { tab: type } })
      }, 500)
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

    toDetail: function (id) {
      setTimeout(() => {
        // this.$router.push({ name: 'news.detail', params: { id } })
        window.open(`${this.$host}/schedule/${id}`)
      }, 500)
    },

    next: function (type = 'recent') {
      if (type === 'recent') {
        this.pagination.recent.page++
      } else if (type === 'have-played') {
        this.pagination.have_played.page++
      }

      this.getEvent(type)
    },

    getEvent: function (type = 'recent') {
      Helper.loading(this)

      return new Promise((resolve, reject) => {
        let page
        if (type === 'recent') {
          page = this.pagination.recent.page
        } else if (type === 'have-played') {
          page = this.pagination.have_played.page
        }

        let endpoint = 'match-schedule/list'
        endpoint = Helper.generateURLParams(endpoint, 'page', page)
        endpoint = Helper.generateURLParams(endpoint, 'limit', 10)
        endpoint = Helper.generateURLParams(endpoint, 'type', type)

        this.$api.get(endpoint).then((response) => {
          const { data, message, status } = response.data

          if (status) {
            if (type === 'recent') {
              const prev = [...this.event.recent]
              this.event.recent = [...prev, ...data.list]

              this.pagination.recent = { 
                page: data.pagination.page,
                total_page: data.pagination.total_page
              }
            } else if (type === 'have-played') {
              const prev = [...this.event.have_played]
              this.event.have_played = [...prev, ...data.list]

              this.pagination.have_played = { 
                page: data.pagination.page,
                total_page: data.pagination.total_page
              }
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

  .event-card {
    width: 100% !important;
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

.event-card-container {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: wrap;
  gap: 20px;
}

.event-card {
  cursor: pointer;
  width: 300px;
  border-bottom-right-radius: 20px;
  border-bottom-left-radius: 20px;
}

section {
  padding: 16px 24px;
}

.page {
  min-height: 75vh;
  max-width: 100%;
  /* width: 720px; */
  margin: auto;
}

.list-container {
  /* width: 600px; */
  max-width: 100%;
}

.logo {
  text-align: center;
  max-height: 75px;
  max-width: 75px;
}

.news-card {
  margin: 10px 0;
  cursor: pointer;
  border-bottom: 4px solid #dedede;
  border-right: 4px solid #dedede;
}

.news-card .club-container {
  display: grid;
  grid-template-columns: 5fr 1fr 5fr;
}

.vs-section {
  grid-template-columns: 7fr 1fr 7fr;
  grid-auto-flow: column;
  display: grid;
}

.schedule-team-logo {
  aspect-ratio: 16/9;
  background-image: url('src/assets/cover_pertandingan_vs2.png');
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
    left: 3%;
    top: 3%;
    display: flex;
    justify-content: center;
    margin: 0 auto;
    color: white;
    font-size: 0.8em;
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
</style>
