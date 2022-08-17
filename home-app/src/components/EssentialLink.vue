<template>
  <q-item class=""
    clickable
    @click="changePage"
  >
    <q-item-section
      v-if="icon"
      avatar
    >
      <q-icon :name="icon" />
    </q-item-section>

    <q-item-section>
      <q-item-label>{{ title }}</q-item-label>
    </q-item-section>
  </q-item>
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'EssentialLink',
  props: {
    title: {
      type: String,
      required: true
    },

    caption: {
      type: String,
      default: ''
    },

    link_name: {
      type: String,
      default: 'home'
    },

    icon: {
      type: String,
      default: ''
    }
  },

  methods: {
    changePage: function () {
      this.$router.push({ name: this.link_name })
    }
  }
})
</script>
