<template>
  <q-layout view="lhh lpR fff">
    <q-header elevated reveal height-hint="98">
      <q-toolbar>
        <q-btn
          flat
          dense
          round
          icon="menu"
          aria-label="Menu"
          class="lt-md"
          @click="toggleLeftDrawer"
        />

        <q-toolbar-title>
          {{ title }}
        </q-toolbar-title>

        <q-tabs align="right" class="md" dense arrow-indicator>
          <q-route-tab :to="{ name: 'home' }" label="Home" icon="home" />
          <q-route-tab :to="{ name: 'club' }" label="Club" icon="groups" />
          <q-route-tab :to="{ name: 'news' }" label="News" icon="newspaper" />
          <!-- <q-route-tab :to="{ name: 'video' }" label="Videos" icon="videocam" />
          <q-route-tab :to="{ name: 'scores' }" label="Scores" icon="scoreboard" /> -->
          <q-route-tab :to="{ name: 'about' }" label="About" icon="description" />
        </q-tabs>
      </q-toolbar>
    </q-header>

    <q-drawer
      behavior="mobile"
      v-model="leftDrawerOpen"
      show-if-above
      bordered
      class="text-white drawer-container"
    >
      <q-list>
        <q-item-label
          header
        >
          Essential Links
        </q-item-label>

        <EssentialLink
          v-for="link in essentialLinks"
          :key="link.title"
          v-bind="link"
        />
      </q-list>
    </q-drawer>

    <q-page-container>
      <div style="min-height: 50vh">
        <router-view v-slot="{ Component }">
          <transition  appear
            enter-active-class="animate__animated animate__fadeIn"
            leave-active-class="animate__animated animate__fadeOut"
          >
            <component :is="Component" />
          </transition>
        </router-view>
      </div>
    </q-page-container>

    <q-footer class="bg-primary text-white q-py-xl q-px-md text-body1">
      <div class="row q-col-gutter-xl">
        <div class="col-6 col-md-4">
          <div>
            <q-avatar v-if="logo !== null">
              <img :src="`${$host}/storage/app/image/${logo}`" width="40px" />
            </q-avatar>
            <div class="q-mt-sm">{{ title }}</div>
          </div>
        </div>

        <div class="col-6 col-md-4">
          <div class="text-bold q-mb-md">Quick Link</div>
          <div class="link" @click="$router.push({ name: 'home' })">Home</div>
          <div class="link" @click="$router.push({ name: 'club' })">Club</div>
          <div class="link" @click="$router.push({ name: 'news' })">News</div>
          <!-- <div class="link" @click="$router.push({ name: 'video' })">Videos</div>
          <div class="link" @click="$router.push({ name: 'scores' })">Scores</div> -->
          <div class="link" @click="$router.push({ name: 'about' })">About</div>
        </div>

        <div class="col-12 col-md-4">
          <div class="text-bold q-mb-md">Contact</div>
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

          <div class="text-bold q-my-md">Follow us</div>
          <div class="flex items-center q-gutter-md">
            <a v-for="item in follow_us" :key="item.id" :href="`${item.link}`" target="_blank" noopener noreferrer>
              <q-img :src="`${$host}/storage/app_follow_us/image/${item.logo}`" :ratio="1" width="30px" />
            </a>
          </div>
        </div>
      </div>
    </q-footer>
  </q-layout>
</template>

<script>
import { defineComponent, ref } from 'vue'
import EssentialLink from 'components/EssentialLink.vue'

const linksList = [
  {
    title: 'Home',
    icon: 'home',
    link_name: 'home'
  },
  {
    title: 'Club',
    icon: 'groups',
    link_name: 'club'
  },
  {
    title: 'News',
    icon: 'newspaper',
    link_name: 'news'
  },
  // {
  //   title: 'Videos',
  //   icon: 'videocam',
  //   link_name: 'video'
  // },
  // {
  //   title: 'Scores',
  //   icon: 'scoreboard',
  //   link_name: 'scores'
  // },
  {
    title: 'About',
    icon: 'description',
    link_name: 'about'
  }
]

export default defineComponent({
  name: 'MainLayout',
  components: { EssentialLink },

  data: () => {
    return {
      title: null,
      logo: null,
      essentialLinks: linksList,
      leftDrawerOpen: ref(false),
      contact_us: [],
      follow_us: []
    }
  },

  mounted: function () {
    this.getAppData()
    this.getContactUs(),
    this.getFollowUs()
  },

  methods: {
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
    },

    toggleLeftDrawer () {
      this.leftDrawerOpen = !this.leftDrawerOpen
    },

    getAppData () {
      this.$api.get('app/detail').then((response) => {
        const { data, message, status } = response.data

        this.title = data.name
        this.logo = data.logo
      })
    }
  }
})
</script>

<style>
  .drawer-container {
    background-image: linear-gradient(
      185deg,
      hsl(213deg 41% 5%) 72%,
      hsl(98deg 40% 11%) 97%,
      hsl(90deg 57% 14%) 101%,
      hsl(87deg 67% 16%) 102%,
      hsl(85deg 76% 18%) 101%,
      hsl(84deg 84% 19%) 101%,
      hsl(82deg 100% 19%) 100%
    );
  }
</style>
