@extends('layouts.master')

@section('content')
  <div id="q-app">
    <q-layout view="hHh LpR fFf" id="home">

      <q-drawer show-if-above v-model="leftDrawerOpen" side="left" bordered class="filter-component">
        Filter Match
      </q-drawer>
  
      <q-page-container>
        <router-view />
      </q-page-container>
  
    </q-layout>
  </div>
@endsection

@section('script')
  <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
      const app = Vue.createApp({
        setup () {
          return {}
        }
      })

      app.use(Quasar)
      app.mount('#q-app')
    })
  </script>
@endsection