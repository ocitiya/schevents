<template>
  <q-page class="q-py-lg q-px-md text-center" style="max-width: 720px; margin: auto;">
    <div>
      <div class="text-bold">Contact</div>

      <div class="q-mt-xl q-gutter-md">
        <q-form @submit="onSubmit" ref="form">
          <q-input
            label="Name*"
            v-model="form.name"
            :rules="[
              val => val && val !== '' || 'This field is required!'
            ]"
          />
          <q-input
            label="email*"
            type="email"
            v-model="form.email"
            :rules="[
              val => val && val !== '' || 'This field is required!'
            ]"
          />
          <q-input
            label="Description*"
            type="textarea"
            v-model="form.description"
            :rules="[
              val => val && val !== '' || 'This field is required!'
            ]"
          />

          <q-btn type="submit" label="Submit" icon="send" unelevated color="primary" class="full-width" />
        </q-form>
      </div>
    </div>
  </q-page>

</template>

<script>
  export default {
    data: function () {
      return {
        form: {
          name: '',
          email: '',
          description: ''
        }
      }
    },

    methods: {
      redirect: function (name) {
        this.$router.push({ name })
      },

      onSubmit: function () {
        this.$refs.form.resetValidation()
        
        this.$router.push({ name: 'home' })

        this.$q.notify({
          message: 'Success',
          color: 'green',
          position: 'top-right'
        })
      }
    }
  }
</script>

<style lang="scss" scoped>
.card-button {
  border: 1px solid #dedede;
}
</style>