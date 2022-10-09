<template>
  <div class="q-px-md q-py-xl page">
    <div class="text-center text-h5 text-primary text-bold">
      About
    </div>

    <div class="flex flex-center text-center q-my-xl">
      <div class="search-container">
        <div v-if="profile.logo !== null">
          <q-img
            :src="`${$host}/storage/app/image/${profile.logo}`"
            width="150px"
            fit="contain"
          />
        </div>

        <div class="q-mt-lg">
          {{ profile.description }}
        </div>
      </div>
    </div>

    <div class="q-my-xl">
      <div class="">
        <div class="text-h5 q-mb-md text-primary text-bold">
          Contact Us
        </div>
        
        <div v-for="item in contact_us" :key="item.id" class="text-justify">
          <q-img
            :src="`${$host}/storage/app_contact_us/image/${item.logo}`"
            width="40px" height="40px"
            fit="contain"
            class="q-mr-md"
          />
          <span class="text-bold">{{ item.name }}:&nbsp;</span>
          <span>{{ item.info }}</span>
        </div>

        <div class="text-h5 q-mb-md text-primary text-bold q-mt-xl">
          Follow Us
        </div>

        <div class="flex items-center q-gutter-md">
          <a v-for="item in follow_us" :key="item.id" :href="`${item.link}`" target="_blank" noopener noreferrer>
            <q-img :src="`${$host}/storage/app_follow_us/image/${item.logo}`" :ratio="1" width="30px" />
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { useMeta } from 'quasar'

export default {
  data: function () {
    return {
      profile: {
        logo: null,
        description: null
      },
      contact_us: [],
      follow_us: []
    }
  },

  mounted: function () {
    useMeta({
      title: 'About'
    })

    this.getProfile()
    this.getContactUs(),
    this.getFollowUs()
  },

  methods: {
    getProfile: function () {
      return new Promise((resolve, reject) => {

        const endpoint = 'app/detail'
        this.$api.get(endpoint).then((response) => {
          const { data, message, status } = response.data

          if (status) {
            this.profile.logo = data.logo
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
</style>
