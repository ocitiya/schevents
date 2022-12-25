<template>
  <q-layout view="lhh lpR fff">
    <q-header elevated reveal height-hint="98">
      <q-toolbar>
        <q-btn flat dense round
          icon="menu"
          aria-label="Menu"
          class="lt-md"
          @click="toggleLeftDrawer"
        />

        <q-toolbar-title>
          <q-avatar class="q-mr-sm">
            <img :src="`${$host}/storage/app/image/${logo}`"/>
          </q-avatar>

          {{ title }}
          <span v-if="is_sub_module">
            {{ ` - ${sub_module_name}` }}
          </span>
        </q-toolbar-title>

        <q-tabs align="right" class="md" dense arrow-indicator>
          <q-route-tab :to="{ name: 'home' }" label="Home" icon="home" />
          <q-route-tab :to="{ name: 'schedule' }" label="Schedule" icon="schedule" />
          <q-route-tab :to="{ name: 'club' }" label="Club" icon="groups" />
          <q-route-tab :to="{ name: 'news' }" label="News" icon="newspaper" />
          <q-route-tab :to="{ name: 'video' }" label="Videos" icon="videocam" />
          <!-- <q-route-tab :to="{ name: 'scores' }" label="Scores" icon="scoreboard" /> -->
          <q-route-tab :to="{ name: 'about' }" label="About" icon="description" />

          <div class="q-ml-md">
            <q-btn icon="widgets" round>
              <q-menu style="min-width: 200px" class="bg-primary text-white">
                <q-item-label header class="text-grey-2">Another Schedules</q-item-label>

                <q-list>
                  <q-item clickable v-close-popup v-ripple @click="$router.push({ name: 'movie' })">
                    <q-item-section avatar>
                      <q-icon name="movie" />
                    </q-item-section>
                    
                    <q-item-section class="text-bold">
                      Movies
                    </q-item-section>
                  </q-item>

                  <q-item clickable v-close-popup v-ripple @click="$router.push({ name: 'event' })">
                    <q-item-section avatar>
                      <q-icon name="event" />
                    </q-item-section>
                    
                    <q-item-section class="text-bold">
                      Events
                    </q-item-section>
                  </q-item>
                </q-list>
              </q-menu>
            </q-btn>
          </div>
        </q-tabs>
      </q-toolbar>
    </q-header>

    <q-drawer
      behavior="mobile"
      v-model="leftDrawerOpen"
      show-if-above
      bordered
      class="text-white drawer-container bg-primary"
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
        <div class="col-12 col-sm-4 col-md-4 text-center">
          <q-avatar v-if="logo !== null">
            <img :src="`${$host}/storage/app/image/${logo}`" width="40px" />
          </q-avatar>
          <div class="q-mt-md">{{ title }}</div>
        </div>

        <div class="col-6 col-sm-4 col-md-4">
          <div class="text-bold q-mb-md">Browse</div>
          <div class="link" @click="$router.push({ name: 'ways-to-watch' })">Ways to Watch</div>
          <div class="link" @click="$router.push({ name: 'schedule' })">
            Streaming Your Sports
          </div>
          <div class="link" @click="$router.push({ name: 'event' })">
            Streaming Your Events
          </div>
        </div>

        <div class="col-6 col-sm-4 col-md-4">
          <div class="text-bold q-mb-md">About Us</div>
          <div class="link" @click="$router.push({ name: 'home' })">
            About schsports
          </div>
          <div class="link" @click="$router.push({ name: 'help-support' })">Help & Supports</div>
          <div class="link" @click="$router.push({ name: 'privacy-policy' })">Privacy Policy</div>
          <div class="link" @click="$router.push({ name: 'terms-of-use' })">Terms of Use</div>
          <div class="link" @click="$router.push({ name: 'contact' })">Contact</div>
        </div>

        <!-- <div class="col-12 col-md-8">
          <div class="q-mx-md">
            
          </div>
        </div> -->

        <div class="col-12 col-md-4">
          <div class="text-bold q-my-md">Follow us</div>
          <div class="flex items-center q-gutter-md">
            <a v-for="item in follow_us" :key="item.id" :href="`${item.link}`" target="_blank" noopener noreferrer>
              <q-img :src="`${$host}/storage/app_follow_us/image/${item.logo}`" :ratio="1" width="30px" />
            </a>
          </div>
        </div>

        <div class="col-12">
          &copy; {{ year }} {{ title }}
        </div>
      </div>
    </q-footer>
  </q-layout>
</template>

<script>
import { defineComponent, ref } from 'vue'
import EssentialLink from 'components/EssentialLink.vue'
import moment from 'moment'

const linksList = [
  {
    title: 'Home',
    icon: 'home',
    link_name: 'home'
  },
  {
    title: 'Schedule',
    icon: 'schedule',
    link_name: 'schedule'
  },
  {
    title: 'Club',
    icon: 'groups',
    link_name: 'club'
  },
  {
    title: 'Events',
    icon: 'event',
    link_name: 'event'
  },
  {
    title: 'News',
    icon: 'newspaper',
    link_name: 'news'
  },
  {
    title: 'Videos',
    icon: 'videocam',
    link_name: 'video'
  },
  // {
  //   title: 'Scores',
  //   icon: 'scoreboard',
  //   link_name: 'scores'
  // },
  {
    title: 'About',
    icon: 'description',
    link_name: 'about'
  },
  {
    title: 'Contact',
    icon: 'contacts',
    link_name: 'contact'
  },
  {
    title: 'Help',
    icon: 'contact_support',
    link_name: 'help-support'
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
      follow_us: [],
      route_name: null,
      is_sub_module: false,
      sub_module_name: null,
      year: null
    }
  },

  mounted: function () {
    this.getAppData()
    this.getContactUs(),
    this.getFollowUs(),

    this.route_name = this.$route.name

    this.year = moment().format('YYYY')
  },

  watch: {
    '$route.name': function (val) {
      this.route_name = val
    },

    route_name: function (val) {
      switch (val) {
        case 'event':
          this.is_sub_module = true
          this.sub_module_name = 'Events'
          break
        
        case 'movie':
          this.is_sub_module = true
          this.sub_module_name = 'Movies'
          break

        default:
          this.is_sub_module = false
          this.sub_module_name = null
          break
      }
    }
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

<style lang="scss" scoped>
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
