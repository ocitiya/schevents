<template>
  <div class="q-px-md q-py-xl page bg-accent" style="min-height: inherit">
    <div>
      <div class="text-center text-h5 text-primary text-bold">
        Athlete Menu
      </div>
  
      <div class="flex flex-center q-my-xl">
        <div class="search-container">
          <q-select filled use-input map-options emit-value
            v-model="search"
            label="Search Athlete"
            input-debounce="0"
            :options="options.athletes"
            @filter="filterAthlete"
            @update:model-value="getData"
            ref="inputAthlete"
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
                <q-img v-if="data.image !== null" class="logo"
                  :src="`${$host}/storage/athlete/image/${data.image}`"
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
                  <span v-if="data.municipality !== null">
                    {{ data.municipality.name }}
                  </span>
                  <span v-if="data.county !== null">
                    , {{ data.county.abbreviation }}
                  </span>
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

    <div class="athlete-list-r">
      <div class="text-center text-h5 text-primary text-bold q-mt-xl">
        Find Your Athlete Today and Follow Your Favorite Athlete
      </div>

      <div class="q-my-lg">
        <!-- <div class="flex items-center q-gutter-lg q-pb-lg q-my-xl q-px-md" style="overflow-x: auto; flex-flow: row"> -->
          <Carousel :settings="settings" :breakpoints="breakpoints">
            <Slide
              v-for="data in randomAthletes"
              :key="data.id"
            >
              <div class="q-px-md">
                <q-card class="q-mx-md">
                  <q-card-section>
                    <q-img v-if="data.image !== null" class="logo"
                      :src="`${$host}/storage/athlete/image/${data.image}`"
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

            <!-- <navigation /> -->
            <pagination />
          </Carousel>
        <!-- </div> -->
      </div>

      <div class="flex flex-center">
        <q-btn label="Find and Stream Your Favorite Athlete" unelevated color="primary" icon="search"
          @click="toInputAthlete"
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
        athletes: []
      },
      master: {
        athletes: []
      },
      randomAthletes: []
    }
  },
  
  mounted: function () {
    useMeta({
      title: 'Athlete'
    })

    this.getRandomAthletes()
  },

  methods: {
    toInputAthlete: function () {
      const inputAthlete = this.$refs.inputAthlete
      inputAthlete.focus()

      Helper.scrollToElement(inputAthlete.$el, 100)
    },

    redirect: function (url) {
      setTimeout(() => {
        window.open(url)
      }, 500)
    },

    toMatchSchedule: function (athlete_id) {
      setTimeout(() => {
        if (searchTimeout) clearTimeout(searchTimeout)
        this.$router.push({ name: 'schedule-athlete', query: { athlete_id } })
      }, 300)
    },

    filterAthlete: function (val, update) {
      if (val.length <= 3) {
        update(() => {
          this.options.athletes = []
        })
        return
      }

      update(() => {
        if (searchTimeout) clearTimeout(searchTimeout)
        searchTimeout = setTimeout(async () => {
          const needle = val.toLowerCase()
          await this.getAthletes(needle)
          this.options.athletes = this.master.athletes.filter(v => v.label.toLowerCase().indexOf(needle) > -1)
        }, 500)
      })
    },

    getAthletes: function (search) {
      Helper.loading(this)

      let endpoint = 'athlete/list'
      endpoint = Helper.generateURLParams(endpoint, 'showall', true)
      endpoint = Helper.generateURLParams(endpoint, 'search', search)

      return new Promise(resolve => {
        this.$api.get(endpoint).then((response) => {
          const { data, message, status } = response.data

          if (status) {
            const athletes = []
            data.list.map(item => {
              athletes.push({
                label: item.name, 
                value: item.id,
                icon: `${this.$host}/storage/athlete/image/${item.image}`
              })
            })

            this.options.athletes = [...athletes]
            this.master.athletes = [...athletes]
            Helper.loading(this, false)

            resolve()
          } else {
            reject()
          }
        })
      })
    },

    getRandomAthletes: function (search) {
      const endpoint = 'athlete/random'

      return new Promise(resolve => {
        this.$api.get(endpoint).then((response) => {
          const { data, message, status } = response.data

          if (status) {
            this.randomAthletes = [...data]
            resolve()
          } else {
            reject()
          }
        })
      })
    },

    getData: function (athlete_id) {
      Helper.loading(this)
      
      return new Promise((resolve, reject) => {
        const endpoint = `athlete/detail/${athlete_id}`
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
.athlete-list-r {
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
