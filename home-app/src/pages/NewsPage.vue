<template>
  <div class="q-py-xl bg-accent">
    <div class="list-container page q-px-xl">
      <div class="q-my-xl">
        <div class="mb-4 flex justify-between items-center">
          <div class="text-h5 text-primary text-bold">Event Today</div>
          <q-btn v-if="event.today.length > 0" flat color="primary" label="See More" @click="toHome('today')" />
        </div>

        <div v-if="event.today.length > 0">
          <vue-horizontal responsive class="v-horizontal" :displacement="0.7" ref="horizontalToday">
            <section v-for="item in event.today" :key="item.id">
              <q-card v-ripple class="event-card" @click="() => toDetail(item.id)">
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
            </section>
          </vue-horizontal>
        </div>

        <div v-else class="text-center text-body1 text-bold q-mt-md">
          No Data Available
        </div>
      </div>

      <div class="q-my-xl">
        <div class="mb-4 flex justify-between items-center">
          <div class="text-h5 text-primary text-bold">Tomorrow</div>
          <q-btn v-if="event.tomorrow.length > 0" flat color="primary" label="See More" @click="toHome('tomorrow')" />
        </div>

        <div v-if="event.tomorrow.length > 0">
          <vue-horizontal responsive class="v-horizontal" :displacement="0.7" ref="horizontalTomorrow">
            <section v-for="item in event.tomorrow" :key="item.id">
              <q-card v-ripple class="event-card" @click="() => toDetail(item.id)">
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
                          <span class="text-bold" v-if="(item.school2.county !== null)">
                            ,&nbsp;{{ item.school2.county.abbreviation }}
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
            </section>
          </vue-horizontal>
        </div>

        <div v-else class="text-center text-body1 text-bold q-mt-md">
          No Data Available
        </div>
      </div>

      <div class="q-my-xl">
        <div class="mb-4 flex justify-between items-center">
          <div class="text-h5 text-primary text-bold">Event This Week</div>
          <q-btn v-if="event.this_week.length > 0" flat color="primary" label="See More" @click="toHome('this-week')" />
        </div>

        <div v-if="event.this_week.length > 0">
          <vue-horizontal responsive class="v-horizontal" :displacement="0.7" ref="horizontalThisWeek">
            <section v-for="item in event.this_week" :key="item.id">
              <q-card v-ripple class="event-card" @click="() => toDetail(item.id)">
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
                          <span class="text-bold" v-if="(item.school2.county !== null)">
                            ,&nbsp;{{ item.school2.county.abbreviation }}
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
            </section>
          </vue-horizontal>
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
import VueHorizontal from "vue-horizontal";

export default {
  components: {VueHorizontal},

  data: function () {
    return {
      loading: true,
      event: {
        today: [],
        this_week: [],
        tomorrow: []
      },
      pagination: {
        today: {
          page: 1,
          total_page: 1
        },
        this_week: {
          page: 1,
          total_page: 1
        },
        tomorrow: {
          page: 1,
          total_page: 1
        }
      }
    }
  },

  mounted: function () {
    this.getEvent('today')
    this.getEvent('this-week')
    this.getEvent('tomorrow')

    useMeta({
      title: 'News',
    })
  },

  methods: {
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

    getEvent: function (type = 'today') {
      Helper.loading(this)

      return new Promise((resolve, reject) => {
        let page
        if (type === 'today') {
          page = this.pagination.today.page
        } else if (type === 'this-week') {
          page = this.pagination.this_week.page
        } else if (type === 'tomorrow') {
          page = this.pagination.tomorrow.page
        }

        let endpoint = 'match-schedule/list'
        endpoint = Helper.generateURLParams(endpoint, 'page', page)
        endpoint = Helper.generateURLParams(endpoint, 'limit', 10)
        endpoint = Helper.generateURLParams(endpoint, 'type', type)

        this.$api.get(endpoint).then((response) => {
          const { data, message, status } = response.data

          if (status) {
            if (type === 'today') {
              this.event.today = [...data.list]
              this.pagination.today = { 
                page: data.pagination.page,
                total_page: data.pagination.total_page
              }
            } else if (type === 'this-week') {
              this.event.this_week = [...data.list]
              this.pagination.this_week = { 
                page: data.pagination.page,
                total_page: data.pagination.total_page
              }
            } else if (type === 'tomorrow') {
              this.event.tomorrow = [...data.list]
              this.pagination.tomorrow = { 
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

<style scoped>
@media only screen and (max-width: 599px) {
  .page {
    padding-left: 20px !important;
    padding-right: 20px !important;
  }
}

/* @media only screen and (max-width: 599px) {
  .event-card {
    width: 100% !important;
  }
} */

.event-card {
  cursor: pointer;
  width: 300px;
  border-radius: 20px;
}

section {
  padding: 16px 24px;
}

.search-container {
  max-width: 100%;
  width: 400px;
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

.card {
  margin: auto;
  display: flex;
  align-items: center;
  flex-wrap: wrap;
  justify-content: center;
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
</style>
