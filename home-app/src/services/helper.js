import { scroll, useQuasar } from 'quasar'

const { getScrollTarget, setVerticalScrollPosition } = scroll
const $q = useQuasar()

export default class Helper {
  static generateURLParams (url, parameter, value) {
    if (url.includes('?')) {
      url += `&${parameter}=${value}`
    } else {
      url += `?${parameter}=${value}`
    }

    return url
  }

  static scrollToElement (el, coffset = null) {
    const target = getScrollTarget(el)
    const offset = coffset === null ? el.offsetTop : coffset
    const duration = 500
    setVerticalScrollPosition(target, offset, duration)
  }

  static loading(_this, state = true, message = null) {
    if (state) {
      _this.$q.loading.show({
        message: message === null ? 'Loading ...' : message
      })
    } else {
      _this.$q.loading.hide()
    }
  }
}