<template>
  <div class="q-px-md q-py-xl page">
    <div class="text-center text-h5 text-primary text-bold">
      Club Menu
    </div>

    <div class="flex flex-center q-my-xl">
      <div class="search-container">
        <q-input v-model="search" label="Search School" filled>
          <template v-slot:append>
            <q-icon name="search" />
          </template>
        </q-input>
      </div>
    </div>

    <div class="text-h6 text-primary text-bold text-center q-my-xl">
      Live Events
    </div>

    <div>
      <div v-if="schedules.length > 0">
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
      </div>

      <div v-else class="text-primary text-h6 text-bold flex flex-center q-my-lg">
        No Live Events
      </div>

      <q-pagination v-if="pagination.total_page > 0"
        class="flex flex-center"
        v-model="pagination.page"
        :max="pagination.total_page"
        @update:model-value="getSchedule"
        input
      />

      <q-inner-loading
        :showing="loadingSchedule"
        label="Please wait..."
        label-class="text-primary"
        label-style="font-size: 1.1em"
      />
    </div>

    <div class="list-container">
      <div class="row q-col-gutter-md">
        <div class="col-12 col-md-4">
          <div class="text-primary text-bold text-h5">
            Sport
          </div>

          <q-list separator class="q-mt-md" v-if="sports.length > 0">
            <q-item v-for="item in sports" :key="item.id" >{{ item.name }}</q-item>
          </q-list>

          <div v-else class="text-primary text-bold">
            No Data Available
          </div>

          <q-pagination v-if="sport.pagination.total_page > 0"
            class="flex flex-center"
            v-model="sport.pagination.page"
            :max="sport.pagination.total_page"
            @update:model-value="getSports"
            input
          />
        </div>

        <div class="col-12 col-md-4">
          <div class="text-primary text-bold text-h5">
            States
          </div>

          <q-list separator class="q-mt-md" v-if="states.length > 0">
            <q-item v-for="item in states" :key="item.id" >{{ item.name }}</q-item>
          </q-list>

          <div v-else class="text-primary text-bold">
            No Data Available
          </div>

          <q-pagination v-if="state.pagination.total_page > 0"
            class="flex flex-center"
            v-model="state.pagination.page"
            :max="state.pagination.total_page"
            @update:model-value="getStates"
            input
          />
        </div>

        <div class="col-12 col-md-4">
          <div class="text-primary text-bold text-h5">
            Associations
          </div>

          <q-list separator class="q-mt-md" v-if="associations.length > 0">
            <q-item v-for="item in associations" :key="item.id" >{{ item.name }}</q-item>
          </q-list>

          <div v-else class="text-primary text-bold">
            No Data Available
          </div>

          <q-pagination v-if="associations.pagination.total_page > 0"
            class="flex flex-center"
            v-model="associations.pagination.page"
            :max="associations.pagination.total_page"
            @update:model-value="associations"
            input
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Helper from 'src/services/helper'

let searchTimeout
export default {
  data: function () {
    return {
      search: null,
      loadingSchedule: true,
      schedules: [],
      sports: [],
      states: [],
      pagination: {
        page: 1,
        total_page: 1
      },
      sport: {
        pagination: {
          page: 1,
          total_page: 1
        }
      },
      state: {
        pagination: {
          page: 1,
          total_page: 1
        }
      },
      associations: {
        pagination: {
          page: 1,
          total_page: 1
        }
      }
    }
  },
  
  mounted: function () {
    this.getSchedule()
    this.getSports()
    this.getStates()
    this.getAssociations()
  },

  watch: {
    search: function (val) {
      if (searchTimeout) clearTimeout(searchTimeout)
      searchTimeout = setTimeout(() => {
        this.getSchedule()
      }, 500)
    }
  },

  methods: {
    getSchedule: function () {
      this.loadingSchedule = true
      return new Promise((resolve, reject) => {
        const page = this.pagination.page

        let endpoint = 'match-schedule/list'
        endpoint = Helper.generateURLParams(endpoint, 'page', page)
        endpoint = Helper.generateURLParams(endpoint, 'type', 'live')

        if (this.search !== null) {
          endpoint = Helper.generateURLParams(endpoint, 'school', this.search)
        }

        this.$api.get(endpoint).then((response) => {
          const { data, message, status } = response.data

          if (status) {
            this.schedules = [...data.list]
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
    },

    getSports: function () {
      return new Promise((resolve, reject) => {
        const page = this.sport.pagination.page

        let endpoint = 'sport-type/list'
        endpoint = Helper.generateURLParams(endpoint, 'page', page)

        this.$api.get(endpoint).then((response) => {
          const { data, message, status } = response.data

          if (status) {
            this.sports = [...data.list]
            this.sport.pagination = {
              ...this.sport.pagination,
              page: data.pagination.page,
              total_page: data.pagination.total_page
            }
            resolve()
          } else {
            reject()
          }
        })
      })
    },

    getStates: function () {
      return new Promise((resolve, reject) => {
        const page = this.state.pagination.page

        let endpoint = 'county/list'
        endpoint = Helper.generateURLParams(endpoint, 'page', page)

        this.$api.get(endpoint).then((response) => {
          const { data, message, status } = response.data

          if (status) {
            this.states = [...data.list]
            this.state.pagination = {
              ...this.state.pagination,
              page: data.pagination.page,
              total_page: data.pagination.total_page
            }
            resolve()
          } else {
            reject()
          }
        })
      })
    },

    getAssociations: function () {
      return new Promise((resolve, reject) => {
        const page = this.associations.pagination.page

        let endpoint = 'association/list'
        endpoint = Helper.generateURLParams(endpoint, 'page', page)

        this.$api.get(endpoint).then((response) => {
          const { data, message, status } = response.data

          if (status) {
            this.associations = [...data.list]
            this.associations.pagination = {
              ...this.associations.pagination,
              page: data.pagination.page,
              total_page: data.pagination.total_page
            }
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

<style scoped>
.search-container {
  max-width: 100%;
  width: 400px;
}

.page {
  max-width: 100%;
  /* width: 720px; */
  margin: auto;
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

.card-schedule-container {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: wrap;
  gap: 20px;
}
</style>
