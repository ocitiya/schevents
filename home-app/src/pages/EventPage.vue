<template>
  <div class="q-px-md q-py-xl page bg-accent" style="min-height: inherit">
    <div>
      <div class="text-center text-h5 text-primary text-bold">
        Events
      </div>
  
      <div class="q-my-xl">
        <div v-if="data.length > 0" class="flex flex-center" style="gap: 40px">
          <div v-for="item in data" :key="item.id">
            <div class="card-event-container">
              <q-card v-ripple
                :class="'event-card '+(item.offer === null ? 'disabled' : null)"
                @click="e => openPage(item.offer.short_link)"
              >
                <q-card-section>
                  <div class="flex flex-center">
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
      
                  <div class="text-center q-mt-lg">
                    <div class="text-bold text-primary q-mt-md">
                      {{ item.name }}
                    </div>
                  </div>
                </q-card-section>
      
                <q-separator />
      
                <q-card-section v-if="item.end_date !== null" class="text-center q-px-md bg-primary text-white">
                  {{ parseDate(item.start_date) }} - {{ parseDate(item.end_date) }}
                </q-card-section>

                <q-card-section v-else class="text-center q-px-md bg-primary text-white">
                  {{ parseDate(item.start_date) }}
                </q-card-section>
              </q-card>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Helper from 'src/services/helper'
import 'moment-timezone'
import moment from 'moment'

import { useMeta } from 'quasar'
import 'vue3-carousel/dist/carousel.css'

export default {
  data: function () {
    return {
      loading: true,
      data: []
    }
  },
  
  mounted: function () {
    useMeta({
      title: 'Event'
    })

    this.getEvents()
  },

  methods: {
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

    getEvents: function (search) {
      Helper.loading(this)

      let endpoint = 'event/list'
      endpoint = Helper.generateURLParams(endpoint, 'showall', true)

      return new Promise(resolve => {
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