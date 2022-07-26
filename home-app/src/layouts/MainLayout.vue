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
          <q-route-tab :to="{ name: 'news' }" label="News" icon="" />
          <q-route-tab :to="{ name: 'video' }" label="Videos" icon="" />
          <q-route-tab :to="{ name: 'scores' }" label="Scores" icon="" />
          <q-route-tab :to="{ name: 'about' }" label="About" icon="description" />
        </q-tabs>
      </q-toolbar>
    </q-header>

    <q-drawer
      behavior="mobile"
      v-model="leftDrawerOpen"
      show-if-above
      bordered
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
          Logo App
          <div>schsports</div>
        </div>

        <div class="col-6 col-md-4">
          <div class="text-bold q-mb-md">Quick Link</div>
          <div class="link" @click="$router.push({ name: 'home' })">Home</div>
          <div class="link" @click="$router.push({ name: 'club' })">Club</div>
          <div class="link">News</div>
          <div class="link">Videos</div>
          <div class="link">Scores</div>
          <div class="link" @click="$router.push({ name: 'about' })">About</div>
        </div>

        <div class="col-12 col-md-4">
          <div class="text-bold q-mb-md">Contact</div>
          <div>email:
            <a href="mailto:admin@schsports.com">
              admin@schsports.com
            </a>
          </div>
          <div>website: 
            <a href="https://schsports.com" target="_blank">
              https://schsports.com
            </a>
          </div>

          <div class="text-bold q-my-md">Follow us</div>
          <div class="flex items-center q-gutter-md">
            <q-img :src="`${$host}/images/ig-logo.png`" :ratio="1" width="20px" />
            <q-img :src="`${$host}/images/fb-logo.png`" :ratio="1" width="20px" />
            <q-img :src="`${$host}/images/twitter-logo.png`" :ratio="1" width="20px" />
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
      essentialLinks: linksList,
      leftDrawerOpen: ref(false)
    }
  },

  mounted: function () {
    this.getAppData()
  },

  methods: {
    toggleLeftDrawer () {
      this.leftDrawerOpen = !this.leftDrawerOpen
    },

    getAppData () {
      this.$api.get('app/detail').then((response) => {
        const { data, message, status } = response.data

        this.title = data.name
      })
    }
  }
})
</script>
