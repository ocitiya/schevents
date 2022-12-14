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
            ref="inputClub"
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
              <div class="flex flex-center">
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
              </div>
  
              <div class="text-center q-mt-lg">
                <div class="text-bold text-primary q-mt-md">
                  {{ data.name }}
                </div>
                <div>
                  {{ data.municipality.name }}, {{ data.county.abbreviation }}
                </div>
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
        <!-- <div class="flex items-center q-gutter-lg q-pb-lg q-my-xl q-px-md" style="overflow-x: auto; flex-flow: row"> -->
          <Carousel :settings="settings" :breakpoints="breakpoints">
            <Slide
              v-for="data in randomSchool"
              :key="data.id"
            >
              <div class="q-px-md">
                <q-card class="q-mx-md">
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
            </Slide>

            <navigation />
            <pagination />
          </Carousel>
        <!-- </div> -->
      </div>

      <div class="flex flex-center">
        <q-btn label="Find and Stream Your Favorite Team" unelevated color="primary" icon="search"
          @click="toInputClub"
        />
      </div>
    </div>
  </div>
</template>

<script>
import Helper from 'src/services/helper'
import 'moment-timezone'
import moment from 'moment'
import { useMeta } from 'quasar'
import { scroll } from 'quasar'

import { Carousel, Pagination, Slide } from 'vue3-carousel'
import 'vue3-carousel/dist/carousel.css'

let searchTimeout

export default {
  components: {
    Carousel,
    Slide,
    Pagination,
  },

  data: function () {
    return {
      settings: {
        itemsToShow: 2.5,
        wrapAround: true,
        itemsToScroll: 1,
        autoplay: 4000
      },
      breakpoints: {
        // 700px and up
        700: {
          itemsToShow: 4.5,
          snapAlign: 'center',
        },
        // 1024 and up
        1024: {
          itemsToShow: 6.5,
          snapAlign: 'start',
        },
      },
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
    toInputClub: function () {
      const inputClub = this.$refs.inputClub
      inputClub.focus()

      Helper.scrollToElement(inputClub.$el, 100)
    },

    redirect: function (url) {
      setTimeout(() => {
        window.open(url)
      }, 500)
    },

    toMatchSchedule: function (school_id) {
      setTimeout(() => {
        if (searchTimeout) clearTimeout(searchTimeout)
        this.$router.push({ name: 'schedule-team', query: { school_id } })
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

.logo {
  text-align: center;
  max-height: 75px;
  max-width: 75px;
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

@media only screen and (max-width: 599px) {
  .card-schedule-container {
    width: 100% !important;
  }
}

.card-schedule-container {
  width: 300px;
}
</style>
