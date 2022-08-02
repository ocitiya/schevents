<template>
  <div class="q-py-xl bg-grey-2">
    <div class="list-container page">
      <div class="">
        <div class="q-pa-md" v-for="[key, group] of Object.entries(notableData)" :key="key">
          <div class="">
            <div class="text-primary text-bold text-body1">
              Noteable HS {{ key }} Games This Week
            </div>

            <div class="flex q-gutter-md q-mt-md clickable-card">
              <q-card v-for="item in group" :key="item.id" class="q-pa-md" v-ripple @click="() => toDetail(item.id)">
                {{ item.school1.name }} Vs {{ item.school2.name }}
              </q-card>
            </div>
          </div>
        </div>
      </div>

      <div class="">
        <div class="text-center text-h5 text-primary text-bold q-mt-xl">
          Have Played
        </div>

        <div class="q-mt-xl" ref="have_played">
          <div v-if="news.have_played.length > 0" class="card q-gutter-lg row">
            <q-card v-for="item in news.have_played" :key="item.id"
              class="col-12 q-pa-md news-card bg-grey-1"
              v-ripple flat
              @click="() => toDetail(item.id)"
            >
              <q-card-section class="">
                <div class="text-primary text-bold text-h6">Football</div>
              </q-card-section >

              <q-card-section class="club-container">
                <div class="column flex items-center">
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
                  <div>{{ item.school1.name }} ({{ item.school1.county.abbreviation }})</div>
                </div>

                <div class="text-body1 text-grey-7 flex flex-center q-px-lg">
                  VS
                </div>
                
                <div class="column flex items-center">
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
                  <div>{{ item.school2.name }} ({{ item.school2.county.abbreviation }})</div>
                </div>
              </q-card-section >
            </q-card>
          </div>

          <div v-else class="text-primary text-bold">
            No Data Available
          </div>

          <q-pagination v-if="have_played.pagination.total_page > 1"
            class="flex flex-center q-mt-lg"
            v-model="have_played.pagination.page"
            :max="have_played.pagination.total_page"
            @update:model-value="getNewsHavePlayed"
            input
          />

          <q-inner-loading
            :showing="loading"
            label="Please wait..."
            label-class="text-primary"
            label-style="font-size: 1.1em"
          />
        </div>
      </div>

      <div class="">
        <div class="text-center text-h5 text-primary text-bold q-mt-xl">
          Last Week Events
        </div>

        <div class="q-mt-xl" ref="last_week">
          <div v-if="news.last_week.length > 0" class="card q-gutter-lg row">
            <q-card v-for="item in news.last_week" :key="item.id"
              class="col-12 q-pa-md news-card bg-grey-1"
              v-ripple flat
              @click="() => toDetail(item.id)"
            >
              <q-card-section class="">
                <div class="text-primary text-bold text-h6">Football</div>
              </q-card-section >

              <q-card-section class="club-container">
                <div class="column flex items-center">
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
                  <div>{{ item.school1.name }} ({{ item.school1.county.abbreviation }})</div>
                </div>

                <div class="text-body1 text-grey-7 flex flex-center q-px-lg">
                  VS
                </div>
                
                <div class="column flex items-center">
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
                  <div>{{ item.school2.name }} ({{ item.school2.county.abbreviation }})</div>
                </div>
              </q-card-section >
            </q-card>
          </div>

          <div v-else class="text-primary text-bold">
            No Data Available
          </div>

          <q-pagination v-if="last_week.pagination.total_page > 1"
            class="flex flex-center q-mt-lg"
            v-model="last_week.pagination.page"
            :max="last_week.pagination.total_page"
            @update:model-value="getNewsLastWeek"
            input
          />

          <q-inner-loading
            :showing="loading"
            label="Please wait..."
            label-class="text-primary"
            label-style="font-size: 1.1em"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Helper from 'src/services/helper'

export default {
  data: function () {
    return {
      search: null,
      tab: 'live',
      loading: true,
      notableData: [],
      news: {
        last_week: [],
        have_played: []
      },
      last_week: {
        pagination: {
          page: 1,
          total_page: 1
        }
      },
      have_played: {
        pagination: {
          page: 1,
          total_page: 1
        },
      }
    }
  },

  mounted: function () {
    this.getNewsLastWeek()
    this.getNewsHavePlayed()
    this.getNotableData()
  },

  methods: {
    toDetail: function (id) {
      setTimeout(() => {
        this.$router.push({ name: 'news.detail', params: { id } })
      }, 500)
    },

    getNotableData: function () {
      this.loading = true
      return new Promise((resolve, reject) => {
        let endpoint = `match-schedule/scores`
        endpoint = Helper.generateURLParams(endpoint, 'type', 'minggu-lalu')

        this.$api.get(endpoint).then((response) => {
          const { data, message, status } = response.data

          if (status) {
            this.notableData = {...data.list}
            resolve()
          }
        }).finally(() => {
          this.loading = false
        })
      })
    },

    getNewsHavePlayed: function () {
      this.loading = true
      return new Promise((resolve, reject) => {
        const page = this.have_played.pagination.page

        let endpoint = 'match-schedule/news/list'
        endpoint = Helper.generateURLParams(endpoint, 'page', page)
        endpoint = Helper.generateURLParams(endpoint, 'limit', 5)
        endpoint = Helper.generateURLParams(endpoint, 'type', 'sudah-bermain')

        this.$api.get(endpoint).then((response) => {
          const { data, message, status } = response.data

          if (status) {
            this.news.have_played = [...data.list]
            this.have_played.pagination = {
              ...this.have_played.pagination,
              page: data.pagination.page,
              total_page: data.pagination.total_page
            }

            const el = this.$refs.have_played
            Helper.scrollToElement(el, -100)
            resolve()
          } else {
            reject()
          }
        }).finally(() => {
          this.loading = false
        })
      })
    },

    getNewsLastWeek: function () {
      this.loading = true
      return new Promise((resolve, reject) => {
        const page = this.last_week.pagination.page

        let endpoint = 'match-schedule/news/list'
        endpoint = Helper.generateURLParams(endpoint, 'page', page)
        endpoint = Helper.generateURLParams(endpoint, 'limit', 5)
        endpoint = Helper.generateURLParams(endpoint, 'type', 'minggu-lalu')

        this.$api.get(endpoint).then((response) => {
          const { data, message, status } = response.data

          if (status) {
            this.news.last_week = [...data.list]
            this.last_week.pagination = {
              ...this.last_week.pagination,
              page: data.pagination.page,
              total_page: data.pagination.total_page
            }

            const el = this.$refs.last_week
            Helper.scrollToElement(el, -100)
            resolve()
          } else {
            reject()
          }
        }).finally(() => {
          this.loading = false
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
  width: 600px;
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
</style>
