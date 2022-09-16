<template>
  <div>
    <q-dialog v-model="visible" @hide="hide" position="bottom">
      <q-card class="card-bottom">
        <q-card-section>
          <div class="text-h6 text-primary">Filter</div>
        </q-card-section>

        <q-card-section class="q-pt-none">
          <q-select use-input map-options emit-value
            label="Federation"
            input-debounce="0"
            v-model="filter.federation_id"
            :options="options.federations"
            @filter="filterFederation"
            @update:model-value="onFederationChange"
          />

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
import Helper from 'src/services/helper'

const defaultFilter = {
  school_id: null,
  federation_id: null
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
        schools: [],
        federations: []
      },
      master: {
        schools: [],
        federations: []
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
    this.getFederations()
  },

  methods: {
    onFederationChange: function (value) {
      this.getSchools(value)
    },

    clearFilter: function () {
      this.filter = {...defaultFilter}
      this.$emit('filter', this.filter)
      this.hide()
    },

    filterSchool: function (val, update) {
      update(() => {
        const needle = val.toLowerCase()
        this.options.schools = this.master.schools.filter(v => v.label.toLowerCase().indexOf(needle) > -1)
      })
    },

    filterFederation: function (val, update) {
      update(() => {
        const needle = val.toLowerCase()
        this.options.federations = this.master.federations.filter(v => v.label.toLowerCase().indexOf(needle) > -1)
      })
    },


    getSchools: function (federation_id = null) {
      Helper.loading(this)
      
      this.options.schools = []
      this.master.schools = []
      window.localStorage.removeItem('masterdata_schools')

      let endpoint = 'school/list'
      endpoint = Helper.generateURLParams(endpoint, 'showall', true)

      if (federation_id !== null) {
        endpoint = Helper.generateURLParams(endpoint, 'federation_id', federation_id)
      }
      this.$api.get(endpoint).then((response) => {
        const { data, message, status } = response.data

        if (status) {
          const schools = []
          data.list.map(item => {
            schools.push({
              label: item.name, 
              value: item.id
            })
          })

          this.options.schools = [...schools]
          this.master.schools = [...schools]
          window.localStorage.setItem('masterdata_schools', JSON.stringify(schools))
        }
      }).finally(() => {
        Helper.loading(this, false)
      })
    },

    getFederations: function () {
      this.options.federations = []
      this.master.federations = []
      window.localStorage.removeItem('masterdata_federations')

      Helper.loading(this)

      let endpoint = 'federation/list'
      endpoint = Helper.generateURLParams(endpoint, 'showall', true)

      this.$api.get(endpoint).then((response) => {
        const { data, message, status } = response.data

        if (status) {
          const federations = []
          data.list.map(item => {
            federations.push({
              label: item.abbreviation, 
              value: item.id
            })
          })

          this.options.federations = [...federations]
          this.master.federations = [...federations]
          window.localStorage.setItem('masterdata_federations', JSON.stringify(federations))
        }
      }).finally(() => {
        Helper.loading(this, false)
      })
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