import { boot } from 'quasar/wrappers'
import axios from 'axios'
import 'moment-timezone'
import moment from 'moment'

// Be careful when using SSR for cross-request state pollution
// due to creating a Singleton instance here;
// If any client changes this (global) instance, it might be a
// good idea to move this instance creation inside of the
// "export default () => {}" function below (which runs individually
// for each client)

const timezone = moment.tz.guess()

// const host = 'https://schevents.com'
const host = process.env.NODE_ENV === 'development' ? 'http://localhost:8000' : 'https://live.schsports.com'
const api = axios.create({
  baseURL: `${host}/api`,
  headers: {
    Timezone : timezone
  }
})

api.interceptors.request.use(function (config) {
  // Do something before request is sent
  return config;
}, function (error) {
  // Do something with request error
  return Promise.reject(error);
});


export default boot(({ app }) => {
  // for use inside Vue files (Options API) through this.$axios and this.$api

  app.config.globalProperties.$host = host
  app.config.globalProperties.$axios = axios
  // ^ ^ ^ this will allow you to use this.$axios (for Vue Options API form)
  //       so you won't necessarily have to import axios in each vue file

  app.config.globalProperties.$api = api
  // ^ ^ ^ this will allow you to use this.$api (for Vue Options API form)
  //       so you can easily perform requests against your app's API
})

export { api }
