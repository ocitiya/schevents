<template>
  <div class="q-px-md q-py-xl page bg-accent" style="min-height: inherit">
    <div>
      <div class="text-center text-h5 text-primary text-bold">
        Movies
      </div>
  
      <div class="q-my-xl">
        <div v-if="data.length > 0" class="flex flex-center" style="gap: 40px">
          <div v-for="item in data" :key="item.id">
            <div class="card-movie-container">
              <q-card v-ripple
                :class="'movie-card '+(item.offer === null ? 'disabled' : null)"
                @click="e => openDetailPage(item)"
              >
                <q-card-section>
                  <div class="flex flex-center">
                    <q-img v-if="item.movie.image !== null" class="logo"
                      :src="`${$host}/storage/movie/image/${item.movie.image}`"
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
                      {{ item.movie.name }}
                    </div>
                  </div>
                </q-card-section>

                <q-separator />

                <q-card-section class="text-center q-px-md bg-primary text-white">
                  <span v-if="item.release_date === null">
                    Coming Soon
                  </span>
                  <span v-else>
                    {{ parseDate(item.release_date) }}
                  </span>
                </q-card-section>
              </q-card>
            </div>
          </div>
        </div>

        <div v-else class="text-center">
          No schedule right now ...
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
      title: 'Movie'
    })

    this.getMovies()
  },

  methods: {
    openDetailPage: function (item) {
      if (item.offer === null) {
        return false
      } else {
        setTimeout(() => {
          window.open(`${this.$host}/movie/schedule/${item.id}`)
        }, 300)
      }
    },

    parseDate: function (date) {
      const mdate = moment(date);

      if (mdate.isValid()) {
        return mdate.format('ddd, DD MMM YYYY')
      } else {
        return '-'
      }
    },

    getMovies: function (search) {
      Helper.loading(this)

      let endpoint = 'movie/schedule/list'
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

.movie-card {
  cursor: pointer;
  width: 300px;
  max-width: 100%;
}

.movie-card.disabled {
  cursor: unset;
}

@media only screen and (max-width: 599px) {
  /* .movie-card {
    width: 100% !important;
  } */
}

@media only screen and (max-width: 599px) {
  .card-movie-container {
    width: 100% !important;
  }
}

.card-movie-container {
  width: 300px;
}
</style>