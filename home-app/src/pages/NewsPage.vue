<template>
  <div class="q-px-xl page list-container bg-grey-1 shadow-1">
    <div class="text-center text-h5 text-primary text-bold q-mt-xl">
      Latest Post
    </div>

    <div class="q-mt-xl" ref="post">
      <div v-if="news.length > 0" class="card q-gutter-lg row">
        <q-card v-for="item in news" :key="item.id"
          class="col-12 q-pa-md news-card"
          v-ripple bordered
          @click="() => toDetail(item.id)"
        >
          <q-section class="">
            <div class="text-primary text-bold">Football</div>
          </q-section>

          <q-section class="club-container">
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
          </q-section>
        </q-card>
      </div>

      <div v-else class="text-primary text-bold">
        No Data Available
      </div>

      <q-pagination v-if="pagination.total_page > 1"
        class="flex flex-center q-mt-lg"
        v-model="pagination.page"
        :max="pagination.total_page"
        @update:model-value="getNews"
        input
      />
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
      news: [],
      pagination: {
        page: 1,
        total_page: 1
      },
    }
  },

  mounted: function () {
    this.getNews()
  },

  methods: {
    toDetail: function (id) {
      setTimeout(() => {
        this.$router.push({ name: 'news.detail', params: { id } })
      }, 500)
    },

    getNews: function () {
      this.loadingSchedule = true
      return new Promise((resolve, reject) => {
        const page = this.pagination.page

        let endpoint = 'match-schedule/news/list'
        endpoint = Helper.generateURLParams(endpoint, 'page', page)

        this.$api.get(endpoint).then((response) => {
          const { data, message, status } = response.data

          if (status) {
            this.news = [...data.list]
            this.pagination = {
              ...this.pagination,
              page: data.pagination.page,
              total_page: data.pagination.total_page
            }

            const el = this.$refs.post
            Helper.scrollToElement(el, -100)
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
}

.news-card .club-container {
  display: grid;
  grid-template-columns: 5fr 1fr 5fr;
}
</style>
