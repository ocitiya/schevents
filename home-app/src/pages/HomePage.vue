<template>
  <div class="">
    <div v-if="Object.keys(banners).length === 0">
      <div class="text-white page-title flex flex-center title-container">
        <div class="text-h4">
          schevents.com
        </div>
      </div>
    </div>

    <div v-else class="bg-secondary q-py-xl">
      <q-carousel
        v-model="slide"
        swipeable animated arrows
        transition-prev="jump-right"
        transition-next="jump-left"
        control-color="white"
        padding infinite autoplay
        height="300px"
        class="text-white bg-secondary animate__animated animate__fadeIn"
      >
        <q-carousel-slide
          v-for="(item, i) in banners" :key="item.id" :name="i"
        >
          <q-img
            :src="`${$host}/storage/banner/image/${item.image}`"
            height="100%"
            width="100%"
            fit="contain"
          />
        </q-carousel-slide>
      </q-carousel>
    </div>

    <div class="page">
      <div class="flex flex-center text-center q-my-xl q-px-md">
        <div class="search-container">
          <div class="text-h6 text-bold">
            About {{ profile.name }}
          </div>
          <div class="q-mt-lg">
            {{ profile.description }}
          </div>
        </div>
      </div>

      <div class="score-card q-my-xl q-px-md">
        <q-card class="shadow-1 full-width bg-secondary" v-for="(item, i) in scores" :key="i">
          <q-card-section class="text-center">
            <q-icon :name="item.icon" size="md" color="white" />
          </q-card-section>

          <q-card-section class="text-center text-white">
            <span>{{ item.score }}</span><br/>
            <span v-if="item.score === 0">{{ item.name }}</span>
            <span v-else>{{ `${item.name}s` }}</span>
          </q-card-section>

          <q-card-actions class="text-center">
            <q-btn color="white" text-color="secondary" size="sm" label="See Detail" unelevated class="full-width" :to="item.link" />
          </q-card-actions>
        </q-card>
      </div>
    </div>
  </div>
</template>

<script>
import { useMeta } from 'quasar'

export default {
  data: function () {
    return {
      slide: 0,
      banners: [],
      profile: {
        name: null,
        description: null
      },
      contact_us: [],
      follow_us: [],
      scores: [
        {
          name: 'Event',
          icon: 'event',
          link: {
            name: 'event'
          },
          score: 0
        },
        {
          name: 'Sport',
          icon: 'sports_soccer',
          link: {
            name: 'schedule'
          },
          score: 0
        },
        {
          name: 'Team',
          icon: 'groups',
          link: {
            name: 'club'
          },
          score: 0
        }
      ]
    }
  },

  mounted: function () {
    useMeta({
      title: 'About'
    })

    this.getBanners()
    this.getProfile()
    this.getContactUs()
    this.getFollowUs()
    this.getCounts()
  },

  methods: {
    getCounts: function () {
      return new Promise((resolve, reject) => {
        let endpoint = 'statistic/count/home'
        this.$api.get(endpoint).then((response) => {
          const { data, message, status } = response.data

          if (status) {
            this.scores[0].score = data.event_score
            this.scores[1].score = data.sport_score
            this.scores[2].score = data.team_score
            resolve()
          } else {
            reject()
          }
        })
      })
    },

    getBanners: function() {
      return new Promise((resolve, reject) => {
        let endpoint = 'banner/list?showall=true'
        this.$api.get(endpoint).then((response) => {
          const { data, message, status } = response.data

          if (status) {
            this.banners = [...data.list]
            resolve()
          } else {
            reject()
          }
        })
      })
    },

    getProfile: function () {
      return new Promise((resolve, reject) => {

        const endpoint = 'app/detail'
        this.$api.get(endpoint).then((response) => {
          const { data, message, status } = response.data

          if (status) {
            this.profile.name = data.name
            this.profile.description = data.description

            resolve()
          } else {
            reject()
          }
        })
      })
    },

    getContactUs: function () {
      return new Promise((resolve, reject) => {

        const endpoint = 'app/contact_us/list?showall=true'
        this.$api.get(endpoint).then((response) => {
          const { data, message, status } = response.data

          if (status) {
            this.contact_us = [...data.list]

            resolve()
          } else {
            reject()
          }
        })
      })
    },

    getFollowUs: function () {
      return new Promise((resolve, reject) => {

        const endpoint = 'app/follow_us/list?showall=true'
        this.$api.get(endpoint).then((response) => {
          const { data, message, status } = response.data

          if (status) {
            this.follow_us = [...data.list]

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
.page {
  max-width: 100%;
  width: 720px;
  margin: auto;
}

.score-card {
  grid-gap: 10px;
  display: grid;
  justify-items: center;
  grid-template-columns: repeat(3, 1fr);
}
</style>
