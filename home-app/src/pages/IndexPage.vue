<template>
  <q-page>
    <div class="bg-primary text-white page-title flex flex-center">
      <div class="text-h4">
        schsports.com
      </div>

      <div class="text-subtitle1 q-mt-lg">
        Find American School Sports Match Schedule
      </div>
    </div>

    <svg id="visual" class="bg-grey-2 title-waves" viewBox="0 0 900 200" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"><path d="M0 62L10.7 60.5C21.3 59 42.7 56 64.2 59C85.7 62 107.3 71 128.8 75.5C150.3 80 171.7 80 193 73.5C214.3 67 235.7 54 257 52.7C278.3 51.3 299.7 61.7 321.2 68.5C342.7 75.3 364.3 78.7 385.8 75.3C407.3 72 428.7 62 450 56.5C471.3 51 492.7 50 514.2 50.7C535.7 51.3 557.3 53.7 578.8 55.7C600.3 57.7 621.7 59.3 643 62.5C664.3 65.7 685.7 70.3 707 68.3C728.3 66.3 749.7 57.7 771.2 54.2C792.7 50.7 814.3 52.3 835.8 56C857.3 59.7 878.7 65.3 889.3 68.2L900 71L900 0L889.3 0C878.7 0 857.3 0 835.8 0C814.3 0 792.7 0 771.2 0C749.7 0 728.3 0 707 0C685.7 0 664.3 0 643 0C621.7 0 600.3 0 578.8 0C557.3 0 535.7 0 514.2 0C492.7 0 471.3 0 450 0C428.7 0 407.3 0 385.8 0C364.3 0 342.7 0 321.2 0C299.7 0 278.3 0 257 0C235.7 0 214.3 0 193 0C171.7 0 150.3 0 128.8 0C107.3 0 85.7 0 64.2 0C42.7 0 21.3 0 10.7 0L0 0Z" fill="#ec7505" stroke-linecap="round" stroke-linejoin="miter"></path></svg>

    <div class="text-right bg-grey-2 q-py-md" style="margin-top: -20px">
      <q-btn label="filter" icon="filter_alt" unelevated color="primary"
        @click="showFilterDialog"
      >
        <q-badge v-if="has_filter" floating color="white" rounded />
      </q-btn>
    </div>

    <q-tabs
      v-model="tab"
      inline-label
      class="bg-grey-2"
      active-class="bg-primary text-white"
      @update:model-value="getSchedule"
    >
      <q-tab name="live" label="Live" />
      <q-tab name="upcoming" label="Upcoming" />
      <q-tab name="this-week" label="This Week" />
      <q-tab name="today" label="Today" />
    </q-tabs>

    <q-pull-to-refresh @refresh="refresh">
      <div class="q-pt-xl page bg-grey-2">
        <div v-if="schedules.length > 0">
          <q-infinite-scroll @load="loadMore">
            <div class="card-schedule-container">
              <div v-for="item in schedules" :key="item.id">
                <q-card v-ripple class="event-card" @click="() => redirect(item.sport_type.stream_url)">
                  <q-card-section class="flex justify-between items-center">
                    <span class="text-primary">
                      <span class="capitalize" v-if="item.team_gender !== null">{{ item.team_gender }},</span>
                      <span v-if="item.team_type !== null">{{ item.team_type.name }},</span>
                      <span v-if="item.sport_type !== null">{{ item.sport_type.name }}</span>
                    </span>                
                  </q-card-section>
    
                  <q-separator />

                  <q-card-section class="q-py-lg">
                    <div class="vs-section q-mb-md">
                      <div v-if="item.school1 !== null" class="text-center q-mr-md">
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

                        <div class="text-bold text-primary q-mt-md">
                          {{ item.school1.name }} ({{ item.school1.county.abbreviation }})
                        </div>
                      </div>

                      <div v-else class="q-ml-md flex flex-center">
                        <div class="text-red text-bold">Unknown School</div>
                      </div>

                      <div class="text-body1 text-grey-7 flex flex-center">
                        VS
                      </div>

                      <div v-if="item.school2 !== null" class="text-center q-ml-md">
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

                        <div class="text-bold text-primary q-mt-md">
                          {{ item.school2.name }} ({{ item.school2.county.abbreviation }})
                        </div>
                      </div>

                      <div v-else class="q-ml-md flex flex-center">
                        <div class="text-red text-bold">Unknown School</div>
                      </div>
                    </div>

                    <div v-if="item.stadium !== null">
                      <q-separator />

                      <div class="flex items-center text-primary q-mt-md">
                        <q-icon name="pin_drop" />&nbsp;
                        {{ item.stadium }}
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

            <template v-slot:loading>
              <div class="flex flex-center q-py-md">
                <q-spinner-dots color="primary" size="40px" />
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

    <match-filter :show="filter.dialog" @hide="hideFilterDialog" @filter="onFilter" />
  </q-page>
</template>

<script>
import { defineComponent } from 'vue'
import 'moment-timezone'
import moment from 'moment'

import MatchFilter from 'src/components/MatchFilter.vue'
import Helper from 'src/services/helper'

export default defineComponent({
  name: 'IndexPage',

  components: { MatchFilter },

  data: function () {
    return {
      filter: {
        dialog: false,
        data: {}
      },
      loadingSchedule: true,
      tab: 'upcoming',
      has_filter: false,
      schedules: [],
      pagination: {
        page: 1,
        total_page: 1
      }
    }
  },

  mounted: function () {
    this.getSchedule()
    this.getSchools()
  },

  methods: {
    getSchools: function () {
      let endpoint = 'school/list'
      endpoint = Helper.generateURLParams(endpoint, 'showall', true)

      this.$api.get(endpoint).then((response) => {
        const { data, message, status } = response.data

        if (status) {
          const schools = []
          data.list.map(item => {
            schools.push({
              label: item.name, 
              value: item.id
            })
          })

          window.localStorage.setItem('masterdata_schools', JSON.stringify(schools))
        }
      })
    },

    onFilter: async function (filter) {
      this.filter.data = { ...filter }
      this.pagination.page = 1
      await this.getSchedule()
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

    redirect: function (url) {
      alert(url)
      setTimeout(() => {
        window.open(url)
      }, 500)
    },

    refresh: async function (done) {
      this.pagination.page = 1
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

<style scoped>
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

  @media only screen and (min-width: 1023px) {
    .page-title {
      min-height: 200px !important;
    }
  }

  .title-waves {
    margin-top: -10px;
  }

  .page {
    padding-left: 70px;
    padding-right: 70px;
    min-height: 400px;
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

  .card-schedule-container {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
    gap: 20px;
  }
</style>
