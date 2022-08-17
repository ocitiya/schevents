<template>
  <div class="q-px-md q-py-xl page bg-accent">
    <div class="text-center text-h5 text-primary text-bold">
      About Menu
    </div>

    <div class="flex flex-center text-center q-my-xl">
      <div class="search-container">
        <div>Logo</div>

        <div>
          Lorem ipsum dolor sit amet consectetur, adipisicing elit. Perspiciatis vitae facere voluptates adipisci reprehenderit iure earum, quasi similique, eveniet temporibus repellat iste iusto eaque alias corporis, ducimus ea. Doloremque, laudantium.
        </div>
      </div>
    </div>

    <div class="q-my-xl row">
      <div class="col-4">
        <div class="text-h5 q-mb-md text-primary text-bold">
          Contact Us
        </div>
        
        <div class="row">
          <div class="col-3">website:</div>
          <div class="col-4">
            <a href="https://schsports.com" target="_blank">
              https://schsports.com
            </a>
          </div>
        </div>

        <div class="row">
          <div class="col-3">email:</div>
          <div class="col-4">
            <a href="mailto:admin@schsports.com">
              admin@schsports.com
            </a>
          </div>
        </div>

        <div class="text-h5 q-mb-md text-primary text-bold q-mt-xl">
          Follow Us
        </div>

        <div class="flex items-center q-gutter-md">
          <q-img :src="`${$host}/images/ig-logo-2.png`" :ratio="1" width="20px" />
          <q-img :src="`${$host}/images/fb-logo-2.png`" :ratio="1" width="20px" />
          <q-img :src="`${$host}/images/twitter-logo-2.png`" :ratio="1" width="20px" />
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
      search: null,
      tab: 'live'
    }
  },

  mounted: function () {
    useMeta({
      title: 'About'
    })
  }
}
</script>

<style scoped>
.search-container {
  max-width: 100%;
  width: 400px;
}

.page {
  max-width: 100%;
  width: 720px;
  margin: auto;
}
</style>
