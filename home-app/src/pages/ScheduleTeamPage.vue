<template>
  <q-page>
    <div class="text-right bg-secondary q-pr-md q-pt-lg q-gutter-x-sm">
      <q-btn label="Athlete Schedule" unelevated color="primary" @click="$router.push({ name: 'schedule-athlete' })" />

      <q-btn label="filter" icon="filter_alt" unelevated color="primary"
        @click="showFilterDialog"
      >
        <q-badge v-if="has_filter" floating color="white" rounded />
      </q-btn>
    </div>

    <div class="bg-secondary q-pb-xl q-pt-md">
      <div class="text-h5 text-center text-bold">
        Club Schedule
      </div>
    </div>

    <q-tabs
      v-model="tab"
      inline-label
      ref="tab"
      class="bg-secondary text-primary"
      active-class="text-white"
      @update:model-value="() => getSchedule(1)"
    >
      <q-tab name="live" label="Live" />
      <q-tab name="upcoming" label="Upcoming" />
      <q-tab name="this-week" label="This Week" />
      <q-tab name="today" label="Today" />
      <q-tab name="tomorrow" label="Tomorrow" />
      <q-tab name="highlight" label="Highlight" />
    </q-tabs>

    <q-pull-to-refresh @refresh="refresh" v-if="tab !== 'highlight'">
      <div class="q-pt-xl page bg-accent">
        <div v-if="schedules.length > 0">
          <q-infinite-scroll @load="loadMore">
            <div class="card-schedule-container">
              <q-card v-for="item in schedules" :key="item.id" v-ripple class="event-card" @click="() => redirect(item.id)">
                <q-card-section class="q-py-lg schedule-team-logo"
                  :style="{
                    backgroundImage: 'linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url(\'' + item.link_stream.image_link + '\')',
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
                    Live&nbsp;
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

                <q-card-section class="text-justify q-px-md bg-secondary text-accent text-bold">
                  <span>
                    Watch: {{ item.school1.name }} vs {{ item.school2.name }} - {{ scheduleTime(item.datetime) }} - {{ scheduleDate(item.datetime) }} -
                  </span>
                  <span class="capitalize" v-if="item.team_gender !== null">{{ item.team_gender }}&nbsp;</span>
                  <span v-if="item.sport !== null">{{ item.sport.name }}</span>
                  <span v-else-if="item.sport_type !== null">{{ item.sport_type.name }}</span>
                  <span v-if="item.stadium !== null">
                     - Live from {{ item.stadium.name }}
                  </span>
                </q-card-section>
              </q-card>
            </div>

            <template v-slot:loading>
              <div class="flex flex-center q-py-md">
                <q-spinner-dots color="accent" size="40px" />
              </div>
            </template>
          </q-infinite-scroll>
        </div>

        <div v-else class="text-primary text-h6 text-bold flex flex-center q-my-lg">
          No Upcoming Events
        </div>

        <q-inner-loading
          :showing="loadingSchedule"
          label="Please wait..."
          label-class="text-primary"
          label-style="font-size: 1.1em"
        />
      </div>
    </q-pull-to-refresh>

    <div v-if="tab === 'highlight'">
      <div class="q-py-xl page bg-accent">
        <div v-if="videos.length > 0">
          <div class="q-gutter-md flex">
            <q-card v-for="item in videos" :key="item.id" class="bg-white q-pa-md event-card" bordered  @click="() => toDetail(item.id)">
              <q-card-section class="q-py-lg schedule-team-logo"
                :style="{
                  backgroundImage: 'linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url(\'' + item.link_stream.image_link + '\')',
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

          <div class="flex items-center justify-center q-mt-md" v-if="pagination_video.page < pagination_video.total_page">
            <q-btn class="" label="See More" color="primary" @click="nextVideoPage" />
          </div>
        </div>

        <div v-else class="text-primary text-h6 text-bold flex flex-center q-my-lg">
          No Data Available
        </div>
      </div>
    </div>

    <match-filter :show="filter.dialog" @hide="hideFilterDialog" @filter="onFilter" />
  </q-page>
</template>

<script>
import { defineComponent } from 'vue'
import 'moment-timezone'
import moment from 'moment'
import { useMeta } from 'quasar'

import MatchFilter from 'src/components/MatchFilter.vue'
import Helper from 'src/services/helper'

export default defineComponent({
  name: 'IndexPage',

  components: { MatchFilter },

  data: function () {
    return {
      logo: null,
      title: null,
      slide: 0,
      banners: [],
      videos: [],
      filter: {
        dialog: false,
        data: {
          school_id: typeof this.$route.query.school_id !== 'undefined' ? this.$route.query.school_id : null,
          champion_id: null,
          sport_id: null,
          date: null
        }
      },
      loadingSchedule: false,
      tab: 'upcoming',
      has_filter: false,
      schedules: [],
      pagination: {
        page: 1,
        total_page: 1
      },
      pagination_video: {
        page: 1,
        total_page: 1
      }
    }
  },

  mounted: function () {
    this.getAppData()

    const tab = this.$route.query.tab
    if (typeof tab !== 'undefined') {
      this.tab = tab
      Helper.scrollToElement(this.$refs.tab.$el)
    }

    if (this.filter.data.school_id !== null) {
      this.filter.data.school_id = this.filter.data.school_id
      this.onFilter(this.filter.data)
    } else {
      this.getSchedule()
    }

    useMeta({
      title: 'Home'
    })
  },

  watch: {
    tab: function (val) {
      if (val === 'highlight') {
        this.getVideo()
      }
    }
  },

  methods: {
    nextVideoPage: function () {
      this.pagination_video.page++;
      this.getVideo();
    },

    getVideo: function (type = 'have-played') {
      Helper.loading(this)

      return new Promise((resolve, reject) => {
        const page = this.pagination_video.page

        let endpoint = 'match-schedule/list'
        endpoint = Helper.generateURLParams(endpoint, 'page', page)
        endpoint = Helper.generateURLParams(endpoint, 'limit', 10)
        endpoint = Helper.generateURLParams(endpoint, 'type', type)

        this.$api.get(endpoint).then((response) => {
          const { data, message, status } = response.data

          if (status) {
            const prev = [...this.videos]
            this.videos = [...prev, ...data.list]

            this.pagination_video = { 
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
    },

    onFilter: async function (filter) {
      this.filter.data = { ...filter }
      if (this.filter.data.date !== null) this.tab = null
      await this.getSchedule(1)
      this.hideFilterDialog()
    },

    hideFilterDialog: function () {
      this.filter.dialog = false
    },

    showFilterDialog: function () {
      this.filter.dialog = true
    },

    loadMore: async function (index, done) {
      const currentPage = this.pagination.page

      if (currentPage < this.pagination.total_page) {
        this.pagination.page = parseInt(currentPage) + 1
        await this.getSchedule()
      }

      done()
    },

    redirect: function (id) {
      setTimeout(() => {
        window.open(`${this.$host}/schedule/${id}`)
      }, 300)
    },

    refresh: async function (done) {
      await this.getSchedule(1)
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

    getAppData: function () {
      this.$api.get('app/detail').then((response) => {
        const { data, message, status } = response.data

        this.title = data.name
        this.logo = data.logo
      })
    },

    getSchedule: function (page = null) {
      if (page !== null) this.pagination.page = page

      this.loadingSchedule = true
      return new Promise((resolve, reject) => {
        const page = this.pagination.page

        let endpoint = 'match-schedule/list'
        endpoint = Helper.generateURLParams(endpoint, 'page', page)
        endpoint = Helper.generateURLParams(endpoint, 'type', this.tab)

        this.has_filter = false
        Object.entries(this.filter.data).forEach(([key, value]) => {
          if (value !== null) {
            this.has_filter = true
            endpoint = Helper.generateURLParams(endpoint, key, value)
          }
        })

        this.$api.get(endpoint).then((response) => {
          const { data, message, status } = response.data

          if (status) {
            if (this.pagination.page === 1) {
              this.schedules = [...data.list]
            } else {
              this.schedules = this.schedules.concat(data.list)
            }

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
          this.loadingSchedule = false
        })
      })
    }
  }
})
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

  @media only screen and (min-width: 600px) and (max-width: 1023px) {
    .page {
      padding-left: 40px !important;
      padding-right: 40px !important; 
    }
  }

  .page {
    padding-left: 70px;
    padding-right: 70px;
    min-height: 400px;
  }

  .event-card {
    cursor: pointer;
    width: 300px;
    border-bottom-right-radius: 20px;
    border-bottom-left-radius: 20px;
  }
  .card-schedule-container {
    display: flex;
    align-items: center;
    justify-content: center;
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

  // .text {
  //   font-size: 10%;
  // }
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
