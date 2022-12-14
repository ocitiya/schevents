<template>
  <q-page>
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
      @update:model-value="() => getSchedule(1)"
    >
      <q-tab name="live" label="Live" />
      <q-tab name="upcoming" label="Upcoming" />
      <q-tab name="this-week" label="This Week" />
      <q-tab name="today" label="Today" />
      <q-tab name="tomorrow" label="Tomorrow" />
    </q-tabs>

    <q-pull-to-refresh @refresh="refresh">
      <div class="q-pt-xl page bg-accent">
        <div v-if="schedules.length > 0">
          <q-infinite-scroll @load="loadMore">
            <div class="card-schedule-container">
              <q-card v-for="item in schedules" :key="item.id" v-ripple class="event-card" @click="() => redirect(item.id)">
                <q-card-section class="flex justify-between items-center">
                  <div class="text-primary">
                    <span v-if="item.team_type !== null">{{ item.team_type.name }}&nbsp;</span>
                    <span class="capitalize" v-if="item.team_gender !== null">{{ item.team_gender }}&nbsp;</span>
                    <span v-if="item.sport !== null">{{ item.sport.name }}</span>
                    <span v-else-if="item.sport_type !== null">{{ item.sport_type.name }}</span>
                  </div>      
                  
                  <div class="text-primary text-bold">
                    <span v-if="(item.championship !== null)">
                      {{ item.championship.abbreviation }}
                    </span>
                    <span v-else-if="(item.federation !== null)">
                      {{ item.federation.abbreviation }}
                    </span>
                  </div>
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

                      <div class="text-primary q-mt-md">
                        <div class="text-bold">{{ item.school1.name }}</div>
                        <div v-if="(item.school1.municipality !== null)">
                          {{ item.school1.municipality.name }}
                          <span class="text-bold" v-if="(item.school1.county !== null)">
                            ,&nbsp;{{ item.school1.county.abbreviation }}
                          </span>
                        </div>
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

                      <div class="text-primary q-mt-md">
                        <div class="text-bold">{{ item.school2.name }}</div>
                        <div v-if="(item.school2.municipality !== null)">
                          {{ item.school2.municipality.name }}
                          <span class="text-bold" v-if="(item.school2.county !== null)">
                            ,&nbsp;{{ item.school2.county.abbreviation }}
                          </span>
                        </div>
                      </div>
                    </div>

                    <div v-else class="q-ml-md flex flex-center">
                      <div class="text-red text-bold">Unknown School</div>
                    </div>
                  </div>

                  <div v-if="item.stadium_id !== null">
                    <q-separator />

                    <div class="flex items-center text-primary q-mt-md">
                      <q-icon name="pin_drop" />&nbsp;
                      {{ item.stadium.name }}
                    </div>
                  </div>
                </q-card-section>

                <q-separator />

                <q-card-section class="flex items-center justify-between q-px-md bg-secondary text-accent text-bold">
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
      slide: 0,
      banners: [],
      filter: {
        dialog: false,
        data: {
          school_id: typeof this.$route.query.school_id !== 'undefined' ? this.$route.query.school_id : null,
          champion_id: null,
          sport_id: null,
          date: null
        }
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

  methods: {
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

<style scoped>
  @media only screen and (max-width: 599px) {
    .options-container {
      padding-right: 20px !important;
    }

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

  .options-container {
    padding-right: 100px;
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
    text-shadow: 2px 3px 0px rgb(120, 120, 120);
  }

  .event-card {
    cursor: pointer;
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

  .title-container {
    background-image: linear-gradient(to bottom, #080d13, #162d44, #194f7c, #1473b9, #0099fa);
  }
</style>
