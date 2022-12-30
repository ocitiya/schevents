<template>
  <div>
    <q-dialog v-model="visible" @hide="hide" position="bottom">
      <q-card class="card-bottom">
        <q-card-section>
          <div class="text-h6 text-primary">Filter</div>
        </q-card-section>

        <q-card-section class="q-pt-none">
          <q-input v-model="filter.date" mask="date" readonly label="Date">
            <template v-slot:append>
              <q-icon name="event" class="cursor-pointer">
                <q-popup-proxy cover transition-show="scale" transition-hide="scale">
                  <q-date v-model="filter.date">
                    <div class="row items-center justify-end">
                      <q-btn v-close-popup label="Close" color="primary" flat />
                    </div>
                  </q-date>
                </q-popup-proxy>
              </q-icon>
            </template>
          </q-input>

          <q-select use-input map-options emit-value
            label="Champions"
            input-debounce="0"
            v-model="filter.champion_id"
            :options="options.champions"
            @filter="filterChampions"
          />

          <q-select use-input map-options emit-value
            label="Sport"
            input-debounce="0"
            v-model="filter.sport_id"
            :options="options.sports"
            @filter="filterSport"
          />

          <q-select use-input map-options emit-value
            label="Athlete"
            input-debounce="0"
            v-model="filter.athlete_id"
            :options="options.athletes"
            @filter="filterAthlete"
          >
            <template v-slot:option="scope">
              <q-item v-bind="scope.itemProps">
                <q-item-section avatar>
                  <q-img :src="scope.opt.icon" />
                </q-item-section>
                <q-item-section>
                  <q-item-label>{{ scope.opt.label }}</q-item-label>
                </q-item-section>
              </q-item>
            </template>
          </q-select>
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
  athlete_id: null,
  champion_id: null,
  sport_id: null,
  date: null
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
        athletes: [],
        champions: [],
        sports: []
      },
      master: {
        athletes: [],
        champions: [],
        sports: []
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
    this.getAthletes()
    this.getChampions()
    this.getSports()
  },

  methods: {
    clearFilter: function () {
      this.filter = {...defaultFilter}
      this.$emit('filter', this.filter)
      this.hide()
    },

    filterAthlete: function (val, update) {
      update(() => {
        const needle = val.toLowerCase()
        this.options.athletes = this.master.athletes.filter(v => v.label.toLowerCase().indexOf(needle) > -1)
      })
    },

    filterChampions: function (val, update) {
      update(() => {
        const needle = val.toLowerCase()
        this.options.champions = this.master.champions.filter(v => v.label.toLowerCase().indexOf(needle) > -1)
      })
    },

    filterSport: function (val, update) {
      update(() => {
        const needle = val.toLowerCase()
        this.options.sports = this.master.sports.filter(v => v.label.toLowerCase().indexOf(needle) > -1)
      })
    },

    getAthletes: function (champion_id = null) {
      Helper.loading(this)
      
      this.options.athletes = []
      this.master.athletes = []
      window.localStorage.removeItem('masterdata_athletes')

      let endpoint = 'athlete/list'
      endpoint = Helper.generateURLParams(endpoint, 'showall', true)

      this.$api.get(endpoint).then((response) => {
        const { data, message, status } = response.data

        if (status) {
          const athletes = []
          data.list.map(item => {
            athletes.push({
              label: item.name, 
              value: item.id,
              icon: `${this.$host}/storage/athlete/image/${item.image}`
            })
          })

          this.options.athletes = [...athletes]
          this.master.athletes = [...athletes]
          window.localStorage.setItem('masterdata_athletes', JSON.stringify(athletes))
        }
      }).finally(() => {
        this.filter.athlete_id = typeof this.$route.query.athlete_id !== 'undefined' ? parseInt(this.$route.query.athlete_id) : null
        Helper.loading(this, false)
      })
    },

    getSports: function (champion_id = null) {
      this.options.sports = []
      this.master.sports = []
      window.localStorage.removeItem('masterdata_sports')

      Helper.loading(this)

      let endpoint = 'sport/list'
      endpoint = Helper.generateURLParams(endpoint, 'showall', true)
      if (champion_id !== null) {
        endpoint = Helper.generateURLParams(endpoint, 'champion_id', champion_id)
      }

      this.$api.get(endpoint).then((response) => {
        const { data, message, status } = response.data

        if (status) {
          const sports = []
          data.list.map(item => {
            sports.push({
              label: item.name, 
              value: item.id
            })
          })

          this.options.sports = [...sports]
          this.master.sports = [...sports]
          window.localStorage.setItem('masterdata_sports', JSON.stringify(sports))
        }
      }).finally(() => {
        Helper.loading(this, false)
      })
    },

    getChampions: function () {
      this.options.champions = []
      this.master.champions = []
      window.localStorage.removeItem('masterdata_champions')

      Helper.loading(this)

      let endpoint = 'championship/list'
      endpoint = Helper.generateURLParams(endpoint, 'showall', true)

      this.$api.get(endpoint).then((response) => {
        const { data, message, status } = response.data

        if (status) {
          const champions = []
          data.list.map(item => {
            champions.push({
              label: item.abbreviation, 
              value: item.id
            })
          })

          this.options.champions = [...champions]
          this.master.champions = [...champions]
          window.localStorage.setItem('masterdata_champions', JSON.stringify(champions))
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