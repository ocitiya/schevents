<template>
  <div class="q-px-md q-py-xl page bg-accent" style="min-height: inherit">
    <div>
      <div class="text-center text-h5 text-primary text-bold">
        Club Menu
      </div>
  
      <div class="flex flex-center q-my-xl">
        <div class="search-container">
          <q-select filled use-input map-options emit-value
            v-model="search"
            label="Search School"
            input-debounce="0"
            :options="options.schools"
            @filter="filterSchool"
            @update:model-value="getData"
          >
            <template v-slot:append>
              <q-icon name="search" />
            </template>
  
            <template v-slot:option="scope">
              <q-item v-bind="scope.itemProps">
                <q-item-section avatar>
                  <q-img :src="scope.opt.icon" />
                </q-item-section>
                <q-item-section>
                  <q-item-label>{{ scope.opt.label }}</q-item-label>
                </q-item-section>
              </q-item>
            </template>
          </q-select>
        </div>
      </div>
  
      <div v-if="Object.keys(data).length > 0" class="flex flex-center">
        <div class="card-schedule-container">
          <q-card v-ripple class="event-card" @click="() => toMatchSchedule(data.id)">
            <q-card-section>
              <q-img v-if="data.logo !== null" class="logo"
                :src="`${$host}/storage/school/logo/${data.logo}`"
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
                {{ data.name }}
              </div>
              <div>
                {{ data.county.name }} {{ data.federation.abbreviation }}
              </div>
            </q-card-section>
  
            <q-separator />
  
            <q-card-section class="text-center q-px-md bg-primary text-white">
              Watch Game
            </q-card-section>
          </q-card>
        </div>
      </div>
    </div>

    <div class="club-list-r">
      <div class="text-center text-h5 text-primary text-bold q-mt-xl">
        Find Your Team Today and Follow Your Favorite Team
      </div>

      <div class="q-my-lg">
        <div class="flex items-center q-gutter-lg q-pb-lg q-my-xl q-px-md" style="overflow-x: auto; flex-flow: row">
          <q-card
            v-for="data in randomSchool"
            :key="data.id"
          >
            <q-card-section>
              <q-img v-if="data.logo !== null" class="logo"
                :src="`${$host}/storage/school/logo/${data.logo}`"
                :ratio="1"
                style="width: 200px; height: 200px"
                fit="contain"
              >
                <template v-slot:error>
                  <img :src="`${$host}/images/no-logo-1.png`" style="width: 100%; height: 100%;">
                </template>
              </q-img>

              <q-img v-else class="logo"
                :src="`${$host}/images/no-logo-1.png`"
                :ratio="1"
              />
            </q-card-section>
          </q-card>
        </div>
      </div>

      <div class="flex flex-center">
        <q-btn label="Find and Stream Your Favorite Team" unelevated color="primary" icon="search" />
      </div>
    </div>
  </div>
</template>

<script>
import Helper from 'src/services/helper'
import 'moment-timezone'
import moment from 'moment'
import { useMeta } from 'quasar'

let searchTimeout
export default {
  data: function () {
    return {
      search: null,
      loadingSchedule: true,
      data: {},
      slide: 0,
      options: {
        schools: []
      },
      master: {
        schools: []
      },
      randomSchool: []
    }
  },
  
  mounted: function () {
    useMeta({
      title: 'Club'
    })

    this.getRandomSchools()
  },

  methods: {
    redirect: function (url) {
      setTimeout(() => {
        window.open(url)
      }, 500)
    },

    toMatchSchedule: function (school_id) {
      setTimeout(() => {
        if (searchTimeout) clearTimeout(searchTimeout)
        this.$router.push({ name: 'home', query: { school_id } })
      }, 300)
    },

    filterSchool: function (val, update) {
      if (val.length <= 3) {
        update(() => {
          this.options.schools = []
        })
        return
      }

      update(() => {
        if (searchTimeout) clearTimeout(searchTimeout)
        searchTimeout = setTimeout(async () => {
          const needle = val.toLowerCase()
          await this.getSchools(needle)
          this.options.schools = this.master.schools.filter(v => v.label.toLowerCase().indexOf(needle) > -1)
        }, 500)
      })
    },

    getSchools: function (search) {
      Helper.loading(this)

      let endpoint = 'school/list'
      endpoint = Helper.generateURLParams(endpoint, 'showall', true)
      endpoint = Helper.generateURLParams(endpoint, 'search', search)

      return new Promise(resolve => {
        this.$api.get(endpoint).then((response) => {
          const { data, message, status } = response.data

          if (status) {
            const schools = []
            data.list.map(item => {
              schools.push({
                label: item.name, 
                value: item.id,
                icon: `${this.$host}/storage/school/logo/${item.logo}`
              })
            })

            this.options.schools = [...schools]
            this.master.schools = [...schools]
            Helper.loading(this, false)

            resolve()
          } else {
            reject()
          }
        })
      })
    },

    getRandomSchools: function (search) {
      const endpoint = 'school/random'

      return new Promise(resolve => {
        this.$api.get(endpoint).then((response) => {
          const { data, message, status } = response.data

          if (status) {
            this.randomSchool = [...data]
            resolve()
          } else {
            reject()
          }
        })
      })
    },

    getData: function (school_id) {
      Helper.loading(this)
      
      return new Promise((resolve, reject) => {
        const endpoint = `school/detail/${school_id}`
        this.$api.get(endpoint).then((response) => {
          const { data, message, status } = response.data

          if (status) {
            this.data = { ...data }
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
.club-list-r {
  padding-top: 100px;
  width: 1024px;
  max-width: 100%;
  margin: auto;
}

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
  cursor: pointer;
  width: 300px;
  border-radius: 20px;
}

@media only screen and (max-width: 599px) {
  .event-card {
    width: 100% !important;
  }
}

.vs-section {
  grid-template-columns: 7fr 1fr 7fr;
  grid-auto-flow: column;
  display: grid;
}

@media only screen and (max-width: 599px) {
  .card-schedule-container {
    width: 100% !important;
  }
}

.card-schedule-container {
  width: 300px;
}
</style>
