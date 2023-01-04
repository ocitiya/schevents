<template>
  <div class="page bg-accent" style="min-height: inherit">
    <div>
      <div class="text-center text-h5 text-white text-bold bg-secondary q-py-xl">
        Events
      </div>
  
      <div class="">
        <div class="text-right bg-secondary q-pr-md q-pt-lg">
          <q-btn label="filter" icon="filter_alt" unelevated color="primary"
            @click="showFilterDialog"
          >
            <q-badge v-if="has_filter" floating color="white" rounded />
          </q-btn>
        </div>
        
        <q-tabs
          v-model="tab"
          inline-label
          ref="tab"
          class="bg-secondary text-primary"
          active-class="text-white"
          @update:model-value="() => getEvents(1)"
        >
          <q-tab name="upcoming" label="Upcoming" />
          <q-tab name="this-week" label="This Week" />
          <q-tab name="live" label="Live" />
        </q-tabs>

        <q-pull-to-refresh @refresh="refresh" style="min-height: 200px;">
          <div v-if="data.length > 0" class="flex flex-center q-py-xl" style="gap: 40px">
            <div v-for="item in data" :key="item.id">
              <q-infinite-scroll @load="loadMore">
                <div class="card-event-container">
                  <q-card class="event-card" clickable v-ripple @click="() => openPage(item.id)">
                    <q-card-section class="event-logo"
                      :style="{
                        backgroundImage: `linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url(\'${item.image_link}\')`,
                        color: 'white',
                        textShadow: '-1px 0 black, 0 1px black, 1px 0 black, 0 -1px black'
                      }">

                      <div class="top">
                        {{ item.name }}
                      </div>

                      <div class="center">
                        <div v-if="item.start_time">
                          <small>
                            {{ item.start_time }}
                          </small>
                        </div>

                        <div v-if="logo != null">
                          <q-img class="logo"
                            :src="`${$host}/storage/app/image/${logo}`"
                            :ratio="1"
                            width="35px"
                          >
                            <template v-slot:error>
                              <img :src="`${$host}/images/no-logo-1.png`" style="width: 100%; height: 100%;">
                            </template>
                          </q-img>
                        </div>

                        <div>
                          <small>
                            {{ scheduleDate(item.start_date) }}
                          </small>
                        </div>
                      </div>

                      <div class="bottom text-caption" style="bottom: 2%; font-size: 0.6em; letter-spacing: 2px;">
                        WWW.SCHSPORTS.COM
                      </div>
                    </q-card-section>

                    <q-card-section>
                      <div class="flex items-center justify-between">
                        <div>
                          <small>
                            <q-icon name="calendar_month" />
                            {{ scheduleDate(item.start_date) }}
                          </small>
                        </div>

                        <div v-if="item.start_time !== null">
                          <small>
                            {{ item.start_time }}
                            <q-icon name="schedule" />
                          </small>
                        </div>
                      </div>
                      <div class="text-body1 q-mt-sm">
                        <b>{{ item.name }} </b>
                      </div>

                      <hr />

                      <div class="text-description" v-html="item.description"></div>
                    </q-card-section>
                  </q-card>
                </div>
              </q-infinite-scroll>
            </div>
          </div>
          <div v-else class="text-center q-mt-xl text-body1">
            No Data
          </div>
        </q-pull-to-refresh>

        <event-filter :show="filter.dialog" @hide="hideFilterDialog" @filter="onFilter" />
      </div>
    </div>
  </div>
</template>

<script>
import Helper from 'src/services/helper'
import 'moment-timezone'
import moment from 'moment'

import EventFilter from 'src/components/EventFilter.vue'
import { useMeta } from 'quasar'
import 'vue3-carousel/dist/carousel.css'

export default {
  components: { EventFilter },
  data: function () {
    return {
      logo: null,
      loading: true,
      data: [],
      tab: 'upcoming',
      has_filter: false,
      schedules: [],
      pagination: {
        page: 1,
        total_page: 1
      },
      filter: {
        dialog: false,
        data: {
          name: null,
          date: null
        }
      },
    }
  },
  
  mounted: function () {
    useMeta({
      title: 'Event'
    })

    this.getAppData()
    this.getEvents()
  },

  methods: {
    getAppData () {
      this.$api.get('app/detail').then((response) => {
        const { data, message, status } = response.data

        
        // this.title = data.name
        this.logo = data.logo
        console.log(this.logo)
      })
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

    onFilter: async function (filter) {
      this.filter.data = { ...filter }
      if (this.filter.data.date !== null) this.tab = 'all'
      await this.getEvents(1)
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
        await this.getEvents()
      }

      done()
    },

    refresh: async function (done) {
      await this.getEvents(1)
      done()
    },

    openPage: function (id) {
      setTimeout(() => {
        window.open(`${this.$host}/event-schedule/${id}`)
      }, 300)
    },

    parseDate: function (date) {
      const mdate = moment(date);

      if (mdate.isValid()) {
        return mdate.format('ddd, DD MMM YYYY')
      } else {
        return '-'
      }
    },

    getEvents: function (page = null) {
      if (page !== null) this.pagination.page = page
      Helper.loading(this)

      return new Promise(resolve => {
        const page = this.pagination.page

        let endpoint = 'event/list'
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
            this.data = [...data.list]
            Helper.loading(this, false)

            resolve()
          } else {
            reject()
          }
        })
      })
    }
  }
}
</script>

<style scoped lang="scss">
.text-description {
  overflow: hidden;
   text-overflow: ellipsis;
   display: -webkit-box;
   -webkit-line-clamp: 3; /* number of lines to show */
           line-clamp: 3; 
   -webkit-box-orient: vertical;
}

.event-card {
  cursor: pointer;
  width: 300px;
  max-width: 100%;

  .event-logo {
    aspect-ratio: 16/9;
    background-size: cover;
    position: relative;
    .top {
      position: absolute;
      right: 0;
      left: 0;
      top: 10%;
      display: flex;
      justify-content: center;
      margin: 0 auto;
      color: white;
      font-size: 1em;
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
      flex-direction: column;
      gap: 7px;
    }

    .bottom {
      position: absolute;
      right: 0;
      left: 0;
      bottom: 5%;
      display: flex;
      justify-content: center;
      margin: 0 auto;
      color: white;
      font-weight: 600;
      font-size: 0.7em;
    }
  }
}

.event-card.disabled {
  cursor: unset;
}

@media only screen and (max-width: 599px) {
  /* .event-card {
    width: 100% !important;
  } */
}

@media only screen and (max-width: 599px) {
  .card-event-container {
    width: 100% !important;
  }
}

.card-event-container {
  width: 300px;
}
</style>