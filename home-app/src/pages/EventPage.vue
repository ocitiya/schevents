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
          <q-tab name="live" label="Live" />
        </q-tabs>

        <q-pull-to-refresh @refresh="refresh" style="min-height: 200px;">
          <div v-if="data.length > 0" class="flex flex-center q-py-xl" style="gap: 40px">
            <div v-for="item in data" :key="item.id">
              <q-infinite-scroll @load="loadMore">
                <div class="card-event-container">
                  <q-card class="event-card">
                    <q-card-section>
                      <div class="flex flex-center q-my-lg">
                        <q-img v-if="item.image !== null" class="logo"
                          :src="`${$host}/storage/event/image/${item.image}`"
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

                      <div v-if="item.end_date !== null" class="">
                        {{ parseDate(item.start_date) }} - {{ parseDate(item.end_date) }}
                      </div>

                      <div v-else class="">
                        {{ parseDate(item.start_date) }}
                      </div>
          
                      <div class="">
                        {{ item.name }}
                      </div>

                      <q-card-section class="text-center">
                        <q-btn unelevated
                          label="Join"
                          color="black"
                          :disable="item.offer === null"
                          @click="e => openPage(item.offer.short_link)"
                        />
                      </q-card-section>
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

    this.getEvents()
  },

  methods: {
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

    openPage: function (link) {
      window.open(link)
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

<style scoped>
.logo {
  text-align: center;
  max-height: 75px;
  max-width: 75px;
}

.event-card {
  cursor: pointer;
  width: 300px;
  max-width: 100%;
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