<template>
  <div>
    <q-dialog v-model="visible" @hide="hide" position="bottom">
      <q-card class="card-bottom">
        <q-card-section>
          <div class="text-h6 text-primary">Filter</div>
        </q-card-section>

        <q-card-section class="q-pt-none">
          <q-select use-input map-options emit-value
            label="School"
            input-debounce="0"
            v-model="filter.school_id"
            :options="options.schools"
            @filter="filterSchool"
          />
        </q-card-section>

        <q-card-actions align="right">
          <q-btn flat icon="backspace" label="Clear Filter" color="primary" @click="clearFilter" />
          <q-btn unelevated icon="filter_alt" label="Filter" color="primary" @click="onFilter" />
        </q-card-actions>
      </q-card>
    </q-dialog>
  </div>
</template>

<script>
const defaultFilter = {
  school_id: null
}

export default {
  props: {
    show: {
      type: Boolean,
      required: true
    }
  },

  data: function () {
    return {
      visible: this.show,
      filter: {...defaultFilter},
      options: {
        schools: []
      },
      master: {
        schools: []
      }
    }
  },

  watch: {
    show: function (val) {
      this.visible = val
      if (!val) {
        this.hide()
      }
    }
  },

  mounted: function () {
    this.getSchools()
  },

  methods: {
    clearFilter: function () {
      this.filter = {...defaultFilter}
      this.$emit('filter', this.filter)
      this.hide()
    },

    filterSchool: function (val, update) {
      if (val === '') {
        update(() => {
          this.options.schools = [...this.master.schools]
        })
        return
      }

      update(() => {
        const needle = val.toLowerCase()
        this.options.schools = this.master.schools.filter(v => v.label.toLowerCase().indexOf(needle) > -1)
      })
    },

    getSchools: function () {
      const masterdata_schools = localStorage.getItem('masterdata_schools')
      if (masterdata_schools !== null) {
        const schools = JSON.parse(masterdata_schools)
        this.options.schools = [...schools]
        this.master.schools = [...schools]
      }
    },

    onFilter: function () {
      this.$emit('filter', this.filter)
      this.hide()
    },

    hide: function () {
      this.visible = false
      this.$emit('hide')
    }
  }
}
</script>