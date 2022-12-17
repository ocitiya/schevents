<template>
  <q-page class="q-py-lg q-px-md text-center" style="max-width: 720px; margin: auto;">
    <div>
      <div class="text-bold">Help & Support</div>

      <div class="q-mt-xl q-gutter-md">
        <q-card class="row q-pa-md card-button" clickable v-ripple flat @click="() => redirect('home')">
          <div class="col-2 text-center">
            <q-icon name="home" size="sm" />
          </div>
          <div class="col-10 text-left text-body1">
            General Info
          </div>
        </q-card>

        <q-card class="row q-pa-md card-button" clickable v-ripple flat @click="() => redirect('about')">
          <div class="col-2 text-center">
            <q-icon name="info" size="sm" />
          </div>
          <div class="col-10 text-left text-body1">
            About schsports
          </div>
        </q-card>

        <q-card class="row q-pa-md card-button" clickable v-ripple flat @click="() => redirect('schedule')">
          <div class="col-2 text-center">
            <q-icon name="sports_soccer" size="sm" />
          </div>
          <div class="col-10 text-left text-body1">
            Streaming Your Sports
          </div>
        </q-card>

        <q-card class="row q-pa-md card-button" clickable v-ripple flat @click="() => redirect('event')">
          <div class="col-2 text-center">
            <q-icon name="event" size="sm" />
          </div>
          <div class="col-10 text-left text-body1">
            Streaming Your Events
          </div>
        </q-card>

        <q-card class="row q-pa-md card-button" clickable v-ripple flat @click="() => redirect('contact')">
          <div class="col-2 text-center">
            <q-icon name="call" size="sm" />
          </div>
          <div class="col-10 text-left text-body1">
            Contact Us
          </div>
        </q-card>
      </div>
    </div>
  </q-page>

</template>

<script>
  export default {
    methods: {
      redirect: function (name) {
        this.$router.push({ name })
      }
    }
  }
</script>

<style lang="scss" scoped>
.card-button {
  border: 1px solid #dedede;
}
</style>